<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 15.1.17
 * Time: 20:10
 */

namespace App\Facades;


class Settings extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'settings';
    }
}