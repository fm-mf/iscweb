<?php

namespace App\Http\Requests;

use App\Models\Contact;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Intervention\Image\Exception\ImageException;
use Intervention\Image\Facades\Image;

class StoreContactRequest extends FormRequest
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
        return Contact::$validationRules;
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if (isset($this['custom_photo'])) {
                $customPhotoDecodedData = base64_decode(explode(',', $this['custom_photo'])[1], true);
                try {
                    $customPhotoImage = Image::make($customPhotoDecodedData)->encode();
                    if (strcasecmp($customPhotoImage->mime(), 'image/jpeg') != 0) {
                        throw new \Exception('The custom_photo must be in JPEG format');
                    }
                    $this['custom_photo'] = $customPhotoImage;
                } catch (ImageException $exception) {
                    $validator->errors()->add('custom_photo', 'The custom_photo must be an image.');
                } catch (\Exception $exception) {
                    $validator->errors()->add('custom_photo', $exception->getMessage());
                }
            }
        });
    }
}
