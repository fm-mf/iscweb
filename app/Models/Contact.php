<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Propaganistas\LaravelPhone\PhoneNumber;

class Contact extends Model
{
    public static $MALE_SILHOUETTE = 'img/web/contacts/male-silhouette-150.jpg';
    public static $FEMALE_SILHOUETTE = 'img/web/contacts/female-silhouette-150.jpg';

    public static $MALE_PHOTO_TYPE = 'male';
    public static $FEMALE_PHOTO_TYPE = 'female';
    public static $CUSTOM_PHOTO_TYPE = 'custom';

    protected $casts = [
        'visible' => 'boolean',
        'phone_visible' => 'boolean',
    ];

    protected $guarded = [];

    public static $validationRules = [
        'position' => ['string', 'required', 'unique:contacts'],
        'email' => ['email', 'required', 'unique:contacts'],
        'name' => ['string', 'nullable'],
        'phone' => ['phone:CZ,SK', 'nullable'],
        'photo' => ['string', 'required'],
        'custom_photo' => ['required_if:photo,custom'],
        'visible' => ['boolean', 'sometimes'],
        'phone_visible' => ['boolean', 'sometimes'],
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }

    public function getPhotoFilePathAttribute() {
        if (strcmp($this->photo, static::$MALE_PHOTO_TYPE) === 0) {
            return asset(static::$MALE_SILHOUETTE);
        }
        if (strcmp($this->photo, static::$FEMALE_PHOTO_TYPE) === 0) {
            return asset(static::$FEMALE_SILHOUETTE);
        }
        if (strcmp($this->photo, static::$CUSTOM_PHOTO_TYPE) === 0 && $this->custom_photo !== null) {
            return asset("storage/{$this->custom_photo}");
        }
        return asset('img/auth/avatar.jpg');
    }

    public function getAvatarAttribute()
    {
        return $this->photoFilePath;
    }

    /**
     * @return string|null Returns string representation of phone number with regular spaces
     * or null if no phone is set
     */
    public function getPhoneWithSpacesAttribute()
    {
        if ($this->phone === null) {
            return null;
        }
        return (new PhoneNumber($this->phone, 'CZ'))->formatInternational();
    }

    /**
     * @return string Returns string representation of phone number with non-breaking spaces
     */
    public function getPhoneWithNBSpacesAttribute()
    {
        return str_replace(' ', ' ' /* &nbsp; */, $this->phoneWithSpaces);
    }

    public function getValidationRulesForEdit()
    {
        $rules = static::$validationRules;
        $rules['position'] = ['string', 'required', "unique:contacts,position,{$this->id}"];
        $rules['email'] = ['email', 'required', "unique:contacts,email,{$this->id}"];
        if (strcasecmp($this->photo, static::$CUSTOM_PHOTO_TYPE) === 0) {
            unset($rules['custom_photo']);
        }
        return $rules;
    }

    public function move($oldIndex, $newIndex)
    {
        $this->order = static::getNextOrder();
        $this->save();
        static::shiftContacts($oldIndex, $newIndex);
        $this->order = $newIndex;
        $this->save();
    }

    private static function shiftContacts($oldIndex, $newIndex)
    {
        if ($newIndex > $oldIndex) {
            static::shiftContactsDown($oldIndex, $newIndex);
        } else {
            static::shiftContactsUp($oldIndex, $newIndex);
        }
    }

    private static function shiftContactsDown($oldIndex, $newIndex)
    {
        $contactsToShift = static::where('order', '>', $oldIndex)
            ->where('order', '<=', $newIndex)->get();
        $contactsToShift->each(function ($contact) {
            $contact->order -= 1;
            $contact->save();
        });
    }

    private static function shiftContactsUp($oldIndex, $newIndex)
    {
        $contactsToShift = static::where('order', '>=', $newIndex)
            ->where('order', '<', $oldIndex)->orderByDesc('order')->get();
        $contactsToShift->each(function ($contact) {
            $contact->order += 1;
            $contact->save();
        });
    }

    public function scopeVisibleOnWeb(Builder $query)
    {
        return $query->where('visible', true);
    }

    public function scopeByPosition(Builder $query, string $position)
    {
        return $query->where('position', $position);
    }

    public function scopeByPositions(Builder $query, array $positions)
    {
        return $query->whereIn('position', $positions);
    }

    public function scopeGetNextOrder(Builder $query)
    {
        return $this->max('order') + 1;
    }

    public function scopeAllWithSubsequentOrder(Builder $query, $startOrder)
    {
        return $query->where('order', '>', $startOrder);
    }
}
