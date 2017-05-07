<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public $timestamps = true;
    public $primaryKey = 'id_vote';

    public static function registerVote($userId, $semesterId, $details)
    {
        $vote = Vote::where('id_user', $userId)->where('id_semester', $semesterId)->first();
        if (!$vote) {
            $vote = new Vote;
            $vote->id_user = $userId;
            $vote->id_semester = $semesterId;
        }
        if (array_key_exists('best_show', $details)) $vote->best_show = $details['best_show'];
        if (array_key_exists('best_food', $details)) $vote->best_food = $details['best_food'];
        $vote->save();
    }

    public static function alreadyVoted($userId, $semesterId)
    {
        if (Vote::where('id_user', $userId)->where('id_semester', $semesterId)->exists()) {
            return true;
        }
        return false;
    }

    public static function findVote($userId, $semesterId)
    {
        $vote = Vote::where('id_user', $userId)->where('id_semester', $semesterId)->first();
        return $vote;
    }
    
}
