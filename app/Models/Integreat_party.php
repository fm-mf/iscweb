<?php namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Integreat_party extends Model {

	protected $fillable = ['id_event', 'countries', 'theme'];
	protected $table = 'integreat_parties';
	public $timestamps = false;
    protected $primaryKey = 'id_event';

    public function Event()
    {
        return $this->belongsTo('\App\Models\Event', 'id_event', 'id_event');
    }

    public static function creatParty($id_event, $data)
    {
        $party = new Integreat_party();
        if(array_key_exists('countries', $data)) $party->countries = $data['countries'];
        if(array_key_exists('theme', $data))$party->theme = $data['theme'];
        $party->id_event = $id_event;
        $party->save();
        return $party;
    }

    /**
     *
     * @param $from: Carbon date
     * @return Collection of integreat parties
     */
    public static function getAllPartiesFrom($from)
    {
        return Integreat_party::wherehas('event', function ($query) use($from) {
                $query->where('type', '=', 'integreat')
                    ->whereDate('visible_from','>=', $from);
            })->get()->sortby('event.datetime_from');
    }

}
