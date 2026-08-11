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

class StoreByLocationModel extends Model {
    protected $table    = 'stores_location';
    public function location() {
        return $this->belongsTo('terre\Admin\Models\LocationModel','fklocationid', 'id');
    }
}