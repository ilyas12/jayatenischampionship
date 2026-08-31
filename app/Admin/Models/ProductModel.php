<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/23/2015
 * Time: 2:52 PM
 */
namespace terre\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model {
    protected $table    = 'product';

    public function images(){
        return $this->hasMany('terre\Admin\Models\ProductImageModel', 'product_id')
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