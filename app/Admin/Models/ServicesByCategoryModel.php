<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/22/2015
 * Time: 4:04 PM
 */
namespace terre\Admin\Models;
use Illuminate\Database\Eloquent\Model;

class ServicesByCategoryModel extends Model {
    protected $table    = 'services_by_category';

    public function category() {
    	return $this->belongsTo('terre\Admin\Models\CategoryModel','fkcategoryid', 'id');
    }
}