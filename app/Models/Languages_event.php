<?php namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Languages_event extends Model {

	protected $fillable = ['id_event', 'where', 'where_url'];
	protected $table = 'languages_events';
	public $timestamps = false;
    protected $primaryKey = 'id_event';

    public function Event()
    {
        return $this->belongsTo('\App\Models\Event', 'id_event', 'id_event');
    }

    public static function creatLanguagesEvent($id_event, $data)
    {
        $langEvent = new Languages_event();
        if(array_key_exists('where', $data)) $langEvent->where = $data['where'];
        if(array_key_exists('where_url', $data))$langEvent->where_url = $data['where_url'];
        $langEvent->id_event = $id_event;
        $langEvent->save();
        return $langEvent;
    }

    /**
     *
     * @param $from: Carbon date
     * @return Collection of languages events
     */
    public static function getLangEventsFrom($from)
    {
        return Languages_event::wherehas('event', function ($query) use($from) {
            $query->where('event_type', '=', 'languages')
                ->whereDate('visible_from','>=', $from);
        })->get()->sortby('event.datetime_from');
    }

    public function update(array $attributes = [], array $options = [])
    {
        if(! array_key_exists('where', $attributes)) $attributes['where'] = NULL;
        if(! array_key_exists('where_url', $attributes)) $attributes['where_url'] = NULL;
        return parent::update($attributes, $options);
    }

}
