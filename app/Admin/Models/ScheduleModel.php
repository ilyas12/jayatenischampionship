<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/22/2015
 * Time: 4:04 PM
 */
namespace terre\Admin\Models;
use Illuminate\Database\Eloquent\Model;

class ScheduleModel extends Model {
    protected $table    = 'schedule';

    public function team() {
        return $this->belongsTo('terre\Admin\Models\TeamProfileModel','fkteamid', 'id');
    }
}