<?php

namespace App\Http\Requests;

use App\Traits\ValidatesImportFile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UsersImportRequest extends FormRequest
{
    use ValidatesImportFile {
        importFileValidator as traitImportFileValidator;
    }

    public function authorize(): bool
    {
        return $this->user()->can('acl', 'users.import');
    }

    public function rules(): array
    {
        return [
            'semester' => ['required', 'numeric', 'exists:semesters,id_semester'],
            'import_file' => ['required', 'file', 'mimes:xls,xlsx,ods'],
            'heading_row_number' => ['required', 'integer', 'min:1'],
            'full_time' => ['sometimes', 'boolean'],
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function (Validator $validator) {
            if ($validator->errors()->has('import_file')) {
                $validator->errors()->add('import_file', 'If you are getting this error and you think your file is fine, try to open it in MS Excel or LibreOffice/OpenOffice and save it again.');
                $validator->errors()->add('import_file', 'If the file was previously saved using some non-standard tool, its format may not be properly recognised.');
            }
        });
    }

    public function messages()
    {
        return [
            'import_file.mimes' => 'The import file must be a valid Excel or OpenDocument spreadsheet file.',
        ];
    }

    public function importFileValidator(): Validator
    {
        $file = $this->file('import_file');
        $headingRowIndex = $this->get('heading_row_number');

        return $this->traitImportFileValidator($file, $headingRowIndex);
    }
}
