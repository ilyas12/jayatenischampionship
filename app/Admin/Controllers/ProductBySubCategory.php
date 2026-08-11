<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/23/2015
 * Time: 2:51 PM
 */
namespace terre\Admin\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use terre\Admin\Models\ProductImageBySubCategoryModel;
use terre\Admin\Models\SubCategoryModel;
use terre\Admin\Models\CategoryModel;
use terre\Admin\Models\ProductBySubCategoryModel;
use terre\Libraries\Alert;
use terre\Systems\Controllers\Systems;

class ProductBySubCategory extends ScaffoldController {
    function __construct(){
        parent::__construct();
        $this->data['page_title']           = "Product";
        $this->model                        = new ProductBySubCategoryModel;
        $this->data['product_admin_size']   = Systems::get('back','product_admin_size');
        $this->data['product_stage_size']   = Systems::get('back','product_stage_size');
    }

    public function index(){
        $this->module_name                  = 'Product';
        $this->base_url                     = '_admin/products-by-subcategory';
        $this->set('multiple_delete', false);
        $this->add_button('order_category', \URL::to($this->base_url.(strstr($this->base_url, '?') ? '&' : '?')."act=order&type=category"), '<i class="glyphicon glyphicon-th-large"></i> Order By Category', array('class'=>'btn btn-warning'));
        switch($this->action){
            case "edit":
                $this->data['sub_title'] = "Edit ".$this->module_name;
                return $this->_edit();
                break;
            case "add":
                $this->data['sub_title'] = "Add ".$this->module_name;
                return $this->_add();
                break;
            case "order":
                $this->data['sub_title'] = "Order ".$this->module_name;
                if (\Request::has('type')){
                    \Cache::forget('type');
                    \Cache::add('type',\Request::input('type'), 3600); // 5.8+: TTL is seconds (was 60 minutes)
                }
                $type = \Cache::get('type');
                if ($type == "category"){
                    $this->_order_category();
                }
                return $this->build();
                break;
            default:
                $this->data['sub_title'] = "List ".$this->module_name;
                $this->_default();
                return $this->build();
                break;
        }
    }

    private function _order_category(){
        $this->order_model       = New ProductBySubCategoryModel;
        $this->model                = $this->model->orderBy('order_category');
        $this->order_field      = 'order_category';
        $this->order_text_field  = 'name';
        $this->order_image_path  = 'resources/assets/uploads/products/';
        $this->order_filter      = [
                                      'category_id' => [
                                                          'title' => "Select Category",
                                                          'data'  => $this->_get_parent_category()
                                                       ]
                                   ];
    }

    private function _get_parent_category(){
        $cat_model = New Categorymodel;
        $all = $cat_model->where('order_id','!=','0')->orderBy('name', 'asc')->get();
        $cat[''] = '&laquo; Select Parent category &raquo;';
        foreach($all as $c){
            $cat[$c->id] = $c['name']; 
        }
        return $cat;
    }

    private function _get_parent_subcategory(){
        $cat_model = New SubCategoryModel;
        $all = $cat_model->where('order_id','!=','0')->orderBy('name', 'asc')->get();
        $cat[''] = '&laquo; Select Parent Sub Category &raquo;';
        foreach($all as $c){
            $cat[$c->id] = $c['name'];
        }
        return $cat;
    }

    private function _default(){
        $this->order_by   = array('name'=>'asc');
        // $this->add_range_filter('created_at');
        $this->before_delete  = 'beforeDelete';
        $this->fields = [
            [
                'name'=>'id',
                'title'=>'Image',
                'width'=> 110,
                'before_show'=>'image'
            ],
            [
                'name'=>'name',
                'title'=>'Name',
                'sort'=> TRUE,
                'search'=> 'text'
            ],
            [
                'name'=>'category_id',
                'title'=>'Category',
                'belongs_to'=>array('category','name'),
                'search'=> $this->_get_category()
            ],
            [
                'name'=>'subcategory_id',
                'title'=>'Sub Category',
                'belongs_to'=>array('subcategory','name'),
                'search'=> $this->_get_subcategory()
            ],
            [
                'name'=>'publish',
                'title'=>'Publish',
                'sort'=> TRUE,
                'type'=> 'check'
            ]
        ];
    }

    public function beforeDelete($data) {
        $productImages  = ProductImageBySubCategoryModel::where('product_id', '=', $data->id)->get();
        $path           = base_path().'/resources/assets/uploads/products/';
        foreach($productImages as $productImage) {
            $img    = $productImage->img;
            if(file_exists($path.$this->data['product_admin_size'].'/'.$img))
	    	    unlink($path.$this->data['product_admin_size'].'/'.$img);
	        if(file_exists($path.$this->data['product_stage_size'].'/'.$img))
            	unlink($path.$this->data['product_stage_size'].'/'.$img);
            $productImage->delete();
        }
    }

    public function _get_category() {
        $categories = CategoryModel::get();
        $return[0]  = '--Select Category--';
        foreach ($categories as $cat) {
            $return[$cat->id]   = $cat->name;
        }
        return $return;
    }

    public function _get_subcategory() {
        $subcategories = SubCategoryModel::get();
        $return[0]  = '--Select Sub Category--';
        foreach ($subcategories as $cat) {
            $return[$cat->id]   = $cat->name;
        }
        return $return;
    }

    private function _add(){
        if(Input::get('submit_save')){
            $input      = Request::all();
            $rules      = ['name' => 'required','category_id' => 'required','subcategory_id' => 'required','description' => 'required'];
            $messages   = ['name.required' => 'The Product Name field is required','category_id.required' =>'The Category field is required','subcategory_id.required' =>'The Sub Category field is required','description.required' => 'The Description field is required',];
            $validator      = Validator::make($input, $rules, $messages);
            $do_save 		= !$validator->fails();
            $error 		 	= $validator->messages();
            if ($do_save) {
                return $this->save();
            } else {
                $message = implode('<br />', $error->all());
                Alert::add($message);
                Redirect::back()->withInput(Input::all());
            }
        }
        $this->data['action']               = "add";
        $this->data['data']                 = ProductBySubCategoryModel::find(0);
        $this->data['loadmce']              = true;
        $this->data['loadjqueryui']         = true;
        $this->data['category_list']        = CategoryModel::all();
        $this->data['sub_category_list']    = SubCategoryModel::all();
        $order_category = $this->model->orderBy('order_category', 'DESC')->first();
        if ( !empty($order_category) ) {
            $order_category   = $order_category->order_category + 1;
        } else {
            $order_category   = 1;
        }
        $this->data['order_category']       = $order_category;
        return $this->render_view("product.form_subcategory");
    }

    private function _edit(){
        if(Input::get('submit_save')){
            $input      = Request::all();
            $rules      = ['name' => 'required','category_id' => 'required','description' => 'required'];
            $messages   = ['name.required' => 'The Product Name field is required','category_id.required' =>'The Category field is required','description.required' => 'The Description field is required',];
            $validator      = Validator::make($input, $rules, $messages);
            $do_save 		= !$validator->fails();
            $error 		 	= $validator->messages();
            if ($do_save) {
                return $this->save();
            } else {
                $message = implode('<br />', $error->all());
                Alert::add($message);
                Redirect::back()->withInput(Input::all());
            }
        }
        $id = Input::get('id');
        $this->data['action']               = "edit";
        $this->data['data']                 = ProductBySubCategoryModel::find($id);
        $this->data['loadmce']              = true;
        $this->data['loadjqueryui']         = true;
        $this->data['category_list']        = CategoryModel::all();
        $this->data['sub_category_list']    = SubCategoryModel::all();
        $this->data['order_category']       = $this->data['data']->order_category;
        return $this->render_view("product.form_subcategory");
    }

    private function save(){
        if(Input::get('submit_save')){
            $action  = Input::get('action');
            if($action == 'add'){
                $product = New ProductBySubCategoryModel();
            }else{
                $product = ProductBySubCategoryModel::find(Input::get('id'));
            }
            $all = Input::all();
            $postAction   = $all['postAction'];
            foreach ($all as $key => $value) {
                if($key != 'submit_save' && $key != 'action' && $key != 'act' && $key !='category' && $key != 'postAction' && $key != '_token'){
                    $save = 1;
                    $product->{$key} = $value;
                }
            }
            if($save){
                $product->permalink = Str::slug($product->name);
                if($action == 'edit')
                {
                    $slugCount = count(ProductBySubCategoryModel::where('id', '!=', $product->id)->whereRaw("permalink REGEXP '^" . $product->permalink . "(-[0-9]*)?$'")->get());
                }
                else
                    $slugCount = count( ProductBySubCategoryModel::whereRaw("permalink REGEXP '^".$product->permalink."(-[0-9]*)?$'")->get() );
                if($slugCount > 0)
                    $product->permalink .= "-".($slugCount+1);
                    $product->save();

                if(isset($all['category'])){
                    foreach ($all['category'] as $cat) {
                        $category = array('category_id'=>$cat, 'product_id'=>$product->id);
                        CategoryModel::insert($category);
                    }
                }
                Alert::add(ucfirst($action).' product success!', 'success');
                if($postAction)
                    return Redirect::to('_admin/products-by-subcategory?act=edit&id='.$product->id);
                return Redirect::to('_admin/products-by-subcategory');
            }
        }
    }

    public function image($product_id){
        $product = ProductBySubCategoryModel::find($product_id);
        if($product->images()->first()){
            return "<img width='100' src='".URL::asset('resources/assets/uploads/products/'.$this->data['product_admin_size'].'/'.$product->images()->first()->img)."'/>";
        }else{
            return "<img width='100' src='".URL::asset('resources/assets/images/none.png')."'/>";
        }
    }

    public function _save_sorting_data(){
        dd(\Request::method());
    }
}