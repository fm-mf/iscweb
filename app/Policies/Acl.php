<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class Acl
{
    public function __construct()
    {

    }

    public function update()
    {
        return true;
    }
}
