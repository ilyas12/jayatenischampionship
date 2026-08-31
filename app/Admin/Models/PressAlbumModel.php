<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/22/2015
 * Time: 4:04 PM
 */
namespace terre\Admin\Models;
use Illuminate\Database\Eloquent\Model;

class PressAlbumModel extends Model {
    protected $table    = 'press_album';

    public function press() {
        return $this->belongsTo('terre\Admin\Models\PressModel','fkpressid', 'id');
    }
}