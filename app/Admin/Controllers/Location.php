<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/26/2015
 * Time: 12:55 AM
 */
namespace terre\Admin\Controllers;

use terre\Admin\Models\LocationModel;
use terre\Systems\Controllers\Systems;

class Location extends ScaffoldController {
    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = "Location";
        $this->model                = new LocationModel;
        $this->base_url 	= '_admin/location';
    }

    public function index() {
        $this->module_name 	= 'Location';
        $this->set('manage_order', true);

        switch($this->action){
            case "edit":
                $this->data['sub_title'] = "Add ".$this->module_name;
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
                'name'=>'name',
                'title'=>'Name',
                'sort'=> TRUE,
                'search'=> 'text'
            ],
        ];
    }

    private function _order(){
        $this->model                = New LocationModel;
        $this->order_model          = New LocationModel;
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
            [
                'name'=>'name',
                'label'=>'Name',
                'validation'=> 'required',
                'permalink'=>'permalink',
            ],
            [
                'name'=>'order_id',
                'type'=>'hidden',
                'value'=> $order_id,
            ],
        ];
    }

    private function _edit(){
        $this->fields 	= [
            [
                'name'=>'name',
                'label'=>'Name',
                'validation'=> 'required',
                'permalink'=>'permalink',
            ],
        ];
    }
}