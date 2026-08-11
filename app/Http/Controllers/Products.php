<?php namespace terre\Http\Controllers;

use terre\Http\Models\BrandModel;
use terre\Http\Models\CategoryModel;
use terre\Http\Models\ProductByCategoryModel;
use terre\Http\Models\ProductImageByCategoryModel;
use terre\Http\Requests;

class Products extends Controller {

    public function __construct() {
        parent::__construct();
        $this->data['page']		            = "Products";
        $this->data['title']	 			= $this->data['meta_title'];
        $this->data['meta_description'] 	= $this->data['meta_description'];
        $this->data['meta_keywords'] 		= $this->data['meta_keywords'];
    }

    public function index()
    {   
        $limit                              = 4;
        $product                            = ProductByCategoryModel::where('publish', '=', 1)->orderBy('order_category','ASC')->paginate($limit);

        
        $this->data['loadMore']             = $product->currentPage() == $product->lastPage() ? false : true;
        $this->data['limit']                = $limit;
        $this->data['total_product']        = count($product);
        $this->data['products']             = $product; 

        return view('products', $this->data);
    }

    public function details($id)
    {
        $productdetails                    = ProductByCategoryModel::where('permalink', '=', $id)->first();
        if ( $productdetails ) {
            $this->data['product_detail']               = $productdetails;
            $this->data['product_detail_images']        = ProductImageByCategoryModel::where('product_id',$productdetails->id)->where('publish',1)->get();
            return view('product_details', $this->data);
        } else {
            return redirect('products');
        }
    }

    public function category($id)
    {
        $category                           = CategoryModel::where('permalink',$id)->first();
        $this->data['category']             = $category->name;
        $this->data['products']             = ProductByCategoryModel::where(['publish'=>1,'category_id'=>$category->id])->orderBy('order_category','ASC')->get();
        return view('products_category', $this->data);
    }

    public function brand($id)
    {
        $brand                              = BrandModel::where('url',$id)->first();
        $this->data['brand']                = $brand->title;
        $this->data['products']             = ProductByCategoryModel::where(['publish'=>1,'brand_id'=>$brand->id])->orderBy('order_category','ASC')->get();
        return view('products_brand', $this->data);
    }
}
