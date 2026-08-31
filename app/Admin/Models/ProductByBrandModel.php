<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/23/2015
 * Time: 2:52 PM
 */
namespace terre\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class ProductByBrandModel extends Model {
    protected $table    = 'product_brand';

    public function brand() {
        return $this->belongsTo('terre\Admin\Models\BrandModel','brand_id', 'id');
    }

    public function images(){
        return $this->hasMany('terre\Admin\Models\ProductImageByBrandModel', 'product_id')
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