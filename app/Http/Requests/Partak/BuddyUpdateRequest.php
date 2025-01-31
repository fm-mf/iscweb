<?php

namespace App\Http\Requests\Partak;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class BuddyUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('acl', 'buddy.edit');
    }

    public function rules(): array
    {
        $exceptId = $this->route()->originalParameter('buddy');

        return [
            'email' => ['required', 'email', 'max:255', "unique:users,email,$exceptId,id_user"],
            'phone' => ['nullable', 'phone:INTERNATIONAL,CZ,SK', 'max:255'],
            'id_country' => ['nullable', 'integer', 'exists:countries'],
            'id_faculty' => ['nullable', 'integer', 'exists:faculties'],
            'sex' => ['nullable', 'string', 'in:M,F'],
            'age' => ['nullable', 'integer', 'min:1901', 'max:2155'],
            'about' => ['nullable', 'string', 'max:16383'],
            'degree_buddy' => ['sometimes', 'accepted'],
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function (Validator $validator) {
            $this->checkPermissionsForUpdatingRoles($validator);
        });
    }

    protected function checkPermissionsForUpdatingRoles(Validator $validator)
    {
        if (
            !key_exists('roles', $this->all())
            || $this->user()->can('acl', 'roles.all')
        ) {
            return;
        }

        $editedUser = $this->route()->parameter('buddy')->user;
        $newRoles = Role::whereIn('id_role', explode(',', $this->input('roles')))->get();
        $oldRoles = $editedUser->roles()->get();

        $rolesToRemove = $oldRoles->diff($newRoles);
        $rolesToAdd = $newRoles->diff($oldRoles);

        foreach ($rolesToAdd as $role) {
            if ($this->user()->cant('acl', "roles.$role->title")) {
                $validator->errors()->add('roles', "You do not have permission to assign the role $role->title");
            }
        }

        foreach ($rolesToRemove as $role) {
            if ($this->user()->cant('acl', "roles.$role->title")) {
                $validator->errors()->add('roles', "You do not have permission to remove the role $role->title");
            }
        }
    }
}
