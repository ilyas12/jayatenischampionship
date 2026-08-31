<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/23/2015
 * Time: 2:52 PM
 */
namespace terre\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBySubCategoryModel extends Model {
    protected $table    = 'product_subcategory';

    public function category() {
        return $this->belongsTo('terre\Admin\Models\CategoryModel','category_id', 'id');
    }

    public function subcategory() {
        return $this->belongsTo('terre\Admin\Models\SubCategoryModel','subcategory_id', 'id');
    }

    public function images(){
        return $this->hasMany('terre\Admin\Models\ProductImageBySubCategoryModel', 'product_id')
            ->orderBy('as_default', 'desc')
            ->orderBy('id', 'asc');
    }

    public function image($product_id){
        $img = $this->images->find($product_id);
        return $img->orderBy('as_default', 'desc')
            ->orderBy('id', 'asc')
            ->first();
    }
}