<?php

namespace App\Http\Requests;

use App\Models\Contact;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Intervention\Image\Exceptions\DecoderException;
use Intervention\Image\Laravel\Facades\Image;

class UpdateContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('acl', 'settings.edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (strcasecmp($this->method(), 'PUT') === 0) {
            $contact = $this->route('contact');
            $this['visible'] = $this['visible'] ?? false;
            $this['phone_visible'] = $this['phone_visible'] ?? false;
            return $contact->getValidationRulesForEdit();
        } else if (strcasecmp($this->method(), 'PATCH') === 0) {
            return [
                'visible' => ['boolean', 'sometimes'],
                'phone_visible' => ['boolean', 'sometimes'],
            ];
        }

        return [];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if (isset($this['custom_photo'])) {
                $customPhotoDecodedData = base64_decode(explode(',', $this['custom_photo'])[1], true);
                try {
                    $customPhotoImage = Image::read($customPhotoDecodedData)->encode();
                    if (strcasecmp($customPhotoImage->mediaType(), 'image/jpeg') != 0) {
                        throw new \Exception('The custom_photo must be in JPEG format');
                    }
                    $this['custom_photo'] = $customPhotoImage;
                } catch (DecoderException $exception) {
                    $validator->errors()->add('custom_photo', 'The custom_photo must be an image.');
                } catch (\Exception $exception) {
                    $validator->errors()->add('custom_photo', $exception->getMessage());
                }
            }
        });
    }
}
