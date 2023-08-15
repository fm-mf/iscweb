<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DegreeStudent extends ExchangeStudent
{
    protected $guarded = [];

    protected $table = 'exchange_students';

    protected static function boot()
    {
        parent::boot();

        // Removes the scope inherited from ExchangeStudent class
        self::addGlobalScope('onlyExchangeStudents', function (Builder $query) {
        });

        self::addGlobalScope('onlyDegreeStudents', function (Builder $query) {
            $query->whereHas('user.roles', function (Builder $query) {
                $query->where('roles.id_role', Role::ID_FULL_TIME);
            })->orWhere('degree_student', true);
        });
    }

    public static function registerDegreeStudent(array $data): self
    {
        return DB::transaction(function () use ($data) {
            $user = User::create(Arr::only($data, ['email', 'password']));
            $person = $user->person()->create(Arr::only($data, ['first_name', 'last_name']));
            return $person->degreeStudent()->create(Arr::only($data, ['id_country', 'id_faculty']));
        });
    }
}
