<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/26/2015
 * Time: 12:55 AM
 */
namespace terre\Admin\Controllers;

use terre\Libraries\Input;
use terre\Admin\Models\CategoryModel;
use terre\Admin\Models\SubCategoryModel;
use terre\Systems\Controllers\Systems;

class SubCategory extends ScaffoldController {
    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = "Sub Category";
        $this->model                = new SubCategoryModel;
    }

    public function index() {
        $this->module_name 	= 'Sub Category';
        $this->base_url 	= '_admin/sub_category';
        $this->set('manage_order', true);

        switch($this->action){
            case "edit":
                $this->data['sub_title'] = "Edit ".$this->module_name;
                $this->_edit();
                break;
            case "add":
                $this->data['sub_title'] = "Add ".$this->module_name;
                $this->_add();
                break;
            case "order":
                $this->data['sub_title'] = "Order ".$this->module_name;
                $this->_order();
                return $this->build();
                break;
            default:
                $this->data['sub_title'] = "List ".$this->module_name;
                $this->_default();
                break;
        }

        return $this->build();
    }

    private function _default(){
        $this->order_by 	= array('order_id'=>'asc');
        $this->fields = [
            [
                'name'=>'fkcategoryid',
                'title'=>'Category',
                'sort'=> TRUE,
                'belongs_to'=> array('category', 'name'),       //--array('function di model', '1 field tabel / *', 'callback')
                'search'=> $this->_get_category()
            ],
            [
                'name'=>'name',
                'title'=>'Sub Category',
                'sort'=> TRUE,
                'search'=> 'text'
            ],
            [
                'name'=>'publish',
                'title'=>'Publish',
                'sort'=> TRUE,
                'type'=>'check',
            ],
        ];
    }

    private function _order(){
        $this->model                = New SubCategoryModel;
        $this->order_model          = New SubCategoryModel;
        $this->table_id             = 'id';
        $this->order_field          = 'order_id';
        $this->order_type_image     = TRUE;
        $this->order_text_field     = 'callback:get_name';
        $this->order_image_field    = 'callback:get_image';
        $this->order_image_path     = 'resources/assets/uploads/product/'.Systems::Get('back','product_admin_size').'/';
    }

    public function get_name($data){
        return $data->name;
    }

    public function get_image(){
        return 'none.png';
    }

    private function _add(){
        $order_id = $this->model->orderBy('order_id', 'DESC')->first();
        if ( !empty($order_id) ) {
            $order_id   = $order_id->order_id + 1;
        } else {
            $order_id   = 1;
        }
        $this->fields 	= [
            [  'name'=>'fkcategoryid',
                'label'=>'Category',
                'type'=>'select',
                'option'=>$this->_get_category(),
                'validation'=>'required'
            ],
            [
                'name'=>'name',
                'label'=>'Sub Category',
                'validation' => 'required',
                'permalink' =>'permalink'
            ],
            [
                'name'=>'order_id',
                'type'=>'hidden',
                'value'=> $order_id,
            ],
        ];
    }


    private function _edit(){

        $this->fields   = [
            [  'name'=>'fkcategoryid',
                'label'=>'Category',
                'type'=>'select',
                'option'=>$this->_get_category(),
                'validation'=>'required'
            ],
            [
                'name'=>'name',
                'label'=>'Sub Category',
                'validation' => 'required',
                'permalink' =>'permalink'
            ],
        ];
    }

    private function _get_category(){
        $model = New CategoryModel;
        $all = $model->all();
        $data['']       = "Choose";
        foreach($all as $prov){
            $data[$prov->id] = $prov['name'];
        }
        return $data;
    }

}