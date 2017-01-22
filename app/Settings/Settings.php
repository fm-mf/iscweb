<?php

namespace App\Settings;

use Illuminate\Contracts\Config\Repository as ConfigContract;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Settings implements ConfigContract
{
    protected $items = array();

    const CACHE_KEY = 'settings';
    const CACHE_TIMEOUT = 10; //in minutes
    const TABLE = 'settings';

    public function __construct()
    {
        Cache::forget(self::CACHE_KEY); //TODO disable forgetting

        $this->items = Cache::remember(self::CACHE_KEY, self::CACHE_TIMEOUT, function() {
            $items = array();
            foreach(DB::table(self::TABLE)->get() as $settingsRow) {
                if ($settingsRow->value == 'true') {
                    $items[$settingsRow->key] = true;
                } else if ($settingsRow->value == 'false') {
                    $items[$settingsRow->key] = false;
                } else if ($settingsRow->value == 'null' || $settingsRow->value == 'NULL') {
                    $items[$settingsRow->key] = null;
                } else {
                    $items[$settingsRow->key] = $settingsRow->value;
                }
            }
            return $items;
        });

    }

    /**
     * Determine if the given configuration value exists.
     *
     * @param  string  $key
     * @return bool
     */
    public function has($key)
    {
        return array_key_exists($key, $this->items);
    }

    /**
     * Get the specified configuration value.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if (!$this->has($key) || $this->items[$key] === null) {
            return $default;
        }
        return $this->items[$key];
    }

    /**
     * Get all of the configuration items for the application.
     *
     * @return array
     */
    public function all()
    {
        return $this->items;
    }

    /**
     * Set a given configuration value.
     *
     * @param  array|string  $key
     * @param  mixed   $value
     * @return void
     */
    public function set($key, $value = null)
    {
        Cache::forget(self::CACHE_KEY);
        $this->items[$key] = $value;
        DB::table(self::TABLE)->where('key', $key)->update(['value' => $value]);
    }

    /**
     * Prepend a value onto an array configuration value.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return void
     */
    public function prepend($key, $value)
    {
        $this->push($key, $value);
    }

    /**
     * Push a value onto an array configuration value.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return void
     */
    public function push($key, $value)
    {
        Cache::forget(self::CACHE_KEY);
        DB::table(self::TABLE)->insert(['key' => $key, 'value'=> $value]);
        $this->items[$key] = $value;
    }

}