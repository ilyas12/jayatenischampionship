<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/23/2015
 * Time: 2:05 PM
 */
namespace terre\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class NewsEventsModel extends Model {
    protected $table    = 'news_events';
    protected $dates    = ['events_date','start_date','end_date'];

    public function getEventsDateAttribute($data) {
        if($data == '0000-00-00') return '0000-00-00';
        else return Carbon::parse($data);
    }

    public function getStartDateAttribute($data) {
        if($data == '0000-00-00') return '0000-00-00';
        else return Carbon::parse($data);
    }

    public function getEndDateAttribute($data) {
        if($data == '0000-00-00') return '0000-00-00';
        else return Carbon::parse($data);
    }
}