<?php

namespace App\Observers;

use App\Facades\Settings;
use App\Models\Contact;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Interfaces\EncodedImageInterface;
use Propaganistas\LaravelPhone\PhoneNumber;

class ContactObserver
{
    public function creating(Contact $contact)
    {
        $contact->order = Contact::getNextOrder();
    }

    public function saving(Contact $contact)
    {
        $this->formatPhone($contact);
        $this->saveCustomPhoto($contact);
        $this->fillMissingAttributes($contact);
    }

    private function formatPhone(Contact $contact)
    {
        if ($contact->phone !== null) {
            $contact->phone = (new PhoneNumber($contact->phone, 'CZ'))->formatE164();
        }
    }

    private function saveCustomPhoto(Contact $contact)
    {
        if ($contact->custom_photo instanceof EncodedImageInterface) {
            $semester = Settings::get('currentSemester');
            $fileName = Str::slug("{$contact->position}-{$contact->name}") . '.jpg';
            $contactsDirPath = "contacts/{$semester}";
            $photoPath = "{$contactsDirPath}/{$fileName}";
            for ($i = 2; Storage::disk('public')->exists($photoPath); $i++) {
                $fileName = Str::slug("{$contact->position}-{$contact->name}-{$i}") . '.jpg';
                $photoPath = "{$contactsDirPath}/{$fileName}";
            }
            Storage::disk('public')->put($photoPath, $contact->custom_photo);
            $contact->custom_photo = $photoPath;
        }
    }

    private function fillMissingAttributes(Contact $contact)
    {
        $contact->visible = $contact->visible ?? false;
        $contact->phone_visible = $contact->phone_visible ?? false;
    }
}
