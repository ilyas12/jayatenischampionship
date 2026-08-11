<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/23/2015
 * Time: 2:52 PM
 */
namespace terre\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ProductByCategoryModel extends Model {
    protected $table    = 'product_category';

    public function category() {
        return $this->belongsTo('terre\Http\Models\CategoryModel','category_id', 'id');
    }

    public function images(){
        return $this->hasMany('terre\Http\Models\ProductImageByCategoryModel', 'product_id')
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