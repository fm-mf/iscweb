<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Ramsey\Uuid\Uuid;

class Person extends Model
{
    use HasFactory;

    const AVATARS_DIR = 'avatars';
    const DEFAULT_AVATAR = 'img/auth/avatar.jpg';
    const AVATAR_SIZE = 360;

    public $timestamps = false;
    protected $primaryKey = 'id_user';
    public $incrementing = false;

    //protected $dates = ['age'];

    protected $fillable = [
        'first_name', 'last_name', 'age', 'sex', 'diet', 'medical_issues', 'avatar'
    ];

    public function user()
    {
        return $this->belongsTo('\App\Models\User', 'id_user', 'id_user');
    }

    public function exchangeStudent()
    {
        return $this->hasOne('\App\Models\ExchangeStudent', 'id_user', 'id_user');
    }

    public function Buddy()
    {
        return $this->hasOne('\App\Models\Buddy', 'id_user', 'id_user');
    }

    public function degreeStudent()
    {
        return $this->hasOne(DegreeStudent::class, 'id_user');
    }

    public function degreeBuddy()
    {
        return $this->hasOne(DegreeBuddy::class, 'id_user');
    }

    public function avatar() {
        return $this->avatar_url;
    }

    public function getAvatarUrlAttribute()
    {
        if (empty($this->avatar)) {
            return asset(self::DEFAULT_AVATAR);
        }

        return asset(self::AVATARS_DIR . "/{$this->avatar}");
    }

    public function setAgeAttribute($age)
    {
        if ($age) {
            $this->attributes['age'] = Carbon::create($age)->year;
        } else {
            $this->attributes['age'] = null;
        }
    }

    public function getAgeAttribute($value)
    {
        if ($value) {
            return Carbon::createFromFormat('Y', $value)->year;
        } else {
            return null;
        }
    }

    public function getSex()
    {
        switch ($this->sex){
            case 'M':
                return 'Male';
            case 'F':
                return 'Female';
            default:
                return 'Hermafrodit';
        }
    }

    public function getSexIcon()
    {
        switch ($this->sex) {
            case 'M':
                return 'fas fa-mars fa-fw sex-icon';
            case 'F':
                return 'fas fa-venus fa-fw sex-icon';
            default:
                return 'fas fa-genderless fa-fw sex-icon';
        }
    }

    public function getEmailAttribute($value)
    {
        return $this->user->email;
    }

    public function setEmailAttribute($value)
    {
        $this->user->email = $value;
    }

    public static function getAllDiets()
    {
        $data = \DB::select('describe people diet');
        preg_match('/^enum\((.*)\)$/', $data[0]->Type, $matches);
        foreach( explode(',', $matches[1]) as $value )
        {
            $value = trim( $value, "'" );
            $enum[$value] = $value;
        }
        return $enum;
    }

    public function updateWithIssuesAndDiet(array $attributes = [], array $options = [])
    {
        if(! array_key_exists('diet', $attributes)) $attributes['diet'] = null;
        if(! array_key_exists('medical_issues', $attributes)) $attributes['medical_issues'] = null;
        return $this->update($attributes, $options);
    }

    public function getShortDiet()
    {
        switch ($this->diet)
        {
            case 'Vegetarian':
                return 'V';
            case 'Vegan':
                return 'Vn';
            case 'Fish only':
                return 'F';
            default:
                return '-';
        }

    }

    public function getFullName($lastNameFirst = false)
    {
        if($lastNameFirst)
            return $this->last_name . ' ' . $this->first_name;
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getHashIdAttribute()
    {
        return $this->user->hashId;
    }

    public function storeAvatar(UploadedFile $file, string $cropData): string
    {
        if (!Storage::exists(self::AVATARS_DIR)) {
            Storage::makeDirectory(self::AVATARS_DIR);
        }

        $cropData = json_decode(stripslashes($cropData));

        $img = Image::read($file)
            ->crop(
                intval($cropData->width),
                intval($cropData->height),
                intval($cropData->x),
                intval($cropData->y)
            )->scaleDown(
                self::AVATAR_SIZE,
                self::AVATAR_SIZE
            );

        $fileExtension = $file->extension();
        $fileName = Uuid::uuid4() . ".{$fileExtension}";
        while (Storage::exists(self::AVATARS_DIR . "/{$fileName}")) {
            $fileName = Uuid::uuid4() . ".{$fileExtension}";
        }
        $filePath = Storage::path(self::AVATARS_DIR . "/{$fileName}");
        $img->save($filePath);

        $oldAvatar = $this->avatar;

        $this->update([
            'avatar' => $fileName,
        ]);

        if (
            !empty($oldAvatar)
            && Storage::exists(self::AVATARS_DIR . "/{$oldAvatar}")
        ) {
            Storage::delete(self::AVATARS_DIR . "/{$oldAvatar}");
        }

        return $fileName;
    }

    public function scopeOrderBySurname(Builder $query): Builder
    {
        return $query
            ->orderBy('last_name')
            ->orderBy('first_name');
    }

    public function scopeOrderByGivenNames(Builder $query): Builder
    {
        return $query
            ->orderBy('first_name')
            ->orderBy('last_name');
    }

    public static function getSexOptions(): array
    {
        return [
            'M' => __('auth.profile.sex-m'),
            'F' => __('auth.profile.sex-f'),
        ];
    }
}
