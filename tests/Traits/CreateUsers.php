<?php
trait CreateUsers
{
    public static function verifiedBuddy()
    {
        $buddy = self::unverifiedBuddy();
        $buddy->setVerified();
        return $buddy;
    }

    public static function unverifiedBuddy()
    {
        return \App\Models\Buddy::registerBuddy([
            'first_name' => 'Buddik',
            'last_name' => 'Dobrota',
            'email' => 'me@emailhaha.cz',
            'password' => 'password'
        ]);
    }
}