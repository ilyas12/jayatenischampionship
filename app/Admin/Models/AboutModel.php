<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/25/2015
 * Time: 8:20 PM
 */
namespace terre\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class AboutModel extends Model {
    protected $table    = 'about';

    public function category() {
        return $this->belongsTo('terre\Admin\Models\AboutCategoryModel','fkaboutcategoryid');
    }
}