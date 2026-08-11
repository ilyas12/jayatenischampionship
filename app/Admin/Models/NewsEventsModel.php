<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/23/2015
 * Time: 2:05 PM
 */
namespace terre\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class NewsEventsModel extends Model {
    protected $table    = 'news_events';
    // Laravel 11 drops $dates in favour of $casts.
    protected $casts    = [
        'events_date' => 'datetime',
        'start_date'  => 'datetime',
        'end_date'    => 'datetime',
    ];

    public function category() {
    	return $this->belongsTo('terre\Admin\Models\CategoryModel','category_id', 'id');
    }

    // Zero dates are now NULL in the database. Carbon::parse(null) returns
    // the CURRENT time, so an undated row would silently render as today —
    // hence the explicit null check rather than relying on the cast. The
    // '0000-00-00' arm is kept so the accessor still behaves on any database
    // that has not had 03-zero-dates.sql applied.
    public function getEventsDateAttribute($data) {
        if (is_null($data) || strpos((string) $data, '0000-00-00') === 0) {
            return null;
        }

        return Carbon::parse($data);
    }

    public function getStartDateAttribute($data) {
        if (is_null($data) || strpos((string) $data, '0000-00-00') === 0) {
            return null;
        }

        return Carbon::parse($data);
    }

    public function getEndDateAttribute($data) {
        if (is_null($data) || strpos((string) $data, '0000-00-00') === 0) {
            return null;
        }

        return Carbon::parse($data);
    }
}