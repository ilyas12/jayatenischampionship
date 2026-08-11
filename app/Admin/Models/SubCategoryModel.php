<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/23/2015
 * Time: 2:58 PM
 */
namespace terre\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategoryModel extends Model {
    protected $table    = 'sub_category';

    public function category() {
        return $this->belongsTo('terre\Admin\Models\CategoryModel','fkcategoryid', 'id');
    }
}