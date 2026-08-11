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
use terre\Admin\Models\BrandModel;
use terre\Admin\Models\ProductByBrandModel;
use terre\Admin\Models\ProductImageByBrandModel;
use terre\Libraries\Alert;
use terre\Systems\Controllers\Systems;

class ProductByBrand extends ScaffoldController {
    function __construct(){
        parent::__construct();
        $this->data['page_title']           = "Product";
        $this->model                        = new ProductByBrandModel;
        $this->data['product_admin_size']   = Systems::get('back','product_admin_size');
        $this->data['product_stage_size']   = Systems::get('back','product_stage_size');
    }

    public function index(){
        $this->module_name                  = 'Product';
        $this->base_url                     = '_admin/products-by-brand';
        $this->set('multiple_delete', false);
        $this->add_button('order_brand', \URL::to($this->base_url.(strstr($this->base_url, '?') ? '&' : '?')."act=order&type=brand"), '<i class="glyphicon glyphicon-th-large"></i> Order By Brand', array('class'=>'btn btn-warning'));
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
                    \Cache::add('type',\Request::input('type'), 60);
                }
                $type = \Cache::get('type');
                if ($type == "brand"){
                    $this->_order_brand();
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

    private function _order_brand(){
        $this->order_model          = New ProductByBrandModel;
        $this->model                = $this->model->orderBy('order_brand');
        $this->order_field          = 'order_brand';
        $this->order_text_field     = 'name';
        $this->order_image_path     = 'resources/assets/uploads/products/';
        $this->order_filter         = [
                                      'brand_id' => [
                                                          'title' => "Select Brand",
                                                          'data'  => $this->_get_parent_brand()
                                                       ]
                                   ];
    }

    private function _get_parent_brand(){
        $cat_model = new BrandModel;
        $all = $cat_model->where('order_id','!=','0')->orderBy('title', 'asc')->get();
        $cat[''] = '&laquo; Select Parent Brand &raquo;';
        foreach($all as $c){
            $cat[$c->id] = $c['title'];
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
                'name'=>'brand_id',
                'title'=>'Brand',
                'belongs_to'=>array('brand','name'),
                'search'=> $this->_get_brand()
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
        $productImages  = ProductImageByBrandModel::where('product_id', '=', $data->id)->get();
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

    public function _get_brand() {
        $categories = BrandModel::get();
        $return[0]  = '--Select Brand--';
        foreach ($categories as $cat) {
            $return[$cat->id]   = $cat->title;
        }
        return $return;
    }

    private function _add(){
        if(Input::get('submit_save')){
            $input      = Request::all();
            $rules      = ['name' => 'required','brand_id' => 'required','description' => 'required'];
            $messages   = ['name.required' => 'The Product Name field is required','brand_id.required' =>'The Brand field is required','description.required' => 'The Description field is required',];
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
        $this->data['data']                 = ProductByBrandModel::find(0);
        $this->data['loadmce']              = true;
        $this->data['loadjqueryui']         = true;
        $this->data['brand_list']           = BrandModel::all();
        $order_brand = $this->model->orderBy('order_brand', 'DESC')->first();
        if ( !empty($order_brand) ) {
            $order_brand   = $order_brand->order_brand + 1;
        } else {
            $order_brand   = 1;
        }
        $this->data['order_brand']       = $order_brand;
        return $this->render_view("product.form_brand");
    }

    private function _edit(){
        if(Input::get('submit_save')){
            $input      = Request::all();
            $rules      = ['name' => 'required','brand_id' => 'required','description' => 'required'];
            $messages   = ['name.required' => 'The Product Name field is required','brand_id.required' =>'The Brand field is required','description.required' => 'The Description field is required',];
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
        $this->data['data']                 = ProductByBrandModel::find($id);
        $this->data['loadmce']              = true;
        $this->data['loadjqueryui']         = true;
        $this->data['brand_list']           = BrandModel::all();
        $this->data['order_brand']          = $this->data['data']->order_brand;
        return $this->render_view("product.form_brand");
    }

    private function save(){
        if(Input::get('submit_save')){
            $action  = Input::get('action');
            if($action == 'add'){
                $product = New ProductByBrandModel();
            }else{
                $product = ProductByBrandModel::find(Input::get('id'));
            }
            $all = Input::all();
            $postAction   = $all['postAction'];
            foreach ($all as $key => $value) {
                if($key != 'submit_save' && $key != 'action' && $key != 'act' && $key !='brand' && $key != 'postAction' && $key != '_token'){
                    $save = 1;
                    $product->{$key} = $value;
                }
            }
            if($save){
                $product->permalink = Str::slug($product->name);
                if($action == 'edit')
                {
                    $slugCount = count(ProductByBrandModel::where('id', '!=', $product->id)->whereRaw("permalink REGEXP '^" . $product->permalink . "(-[0-9]*)?$'")->get());
                }
                else
                    $slugCount = count( ProductByBrandModel::whereRaw("permalink REGEXP '^".$product->permalink."(-[0-9]*)?$'")->get() );
                if($slugCount > 0)
                    $product->permalink .= "-".($slugCount+1);
                    $product->save();

                if(isset($all['brand'])){
                    foreach ($all['brand'] as $cat) {
                        $brand = array('brand_id'=>$cat, 'product_id'=>$product->id);
                        BrandModel::insert($brand);
                    }
                }
                Alert::add(ucfirst($action).' product success!', 'success');
                if($postAction)
                    return Redirect::to('_admin/products-by-brand?act=edit&id='.$product->id);
                return Redirect::to('_admin/products-by-brand');
            }
        }
    }

    public function image($product_id){
        $product = ProductByBrandModel::find($product_id);
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