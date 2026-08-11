<?php

namespace terre\Admin\Controllers;

use terre\Admin\Models\AboutCategoryModel;

class AboutCategory extends ScaffoldController {

    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = "About Category";
        $this->model                = new AboutCategoryModel;
    }
    public function index() {
        $this->module_name 	= 'About Category';
        $this->base_url 	= '_admin/about_by_category';
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
                break;
            default:
                $this->data['sub_title'] = "List ".$this->module_name;
                $this->_default();
                break;
        }
        return $this->build();
    }

    private function _order(){
        $this->order_model          = $this->model;
        $this->order_field			= 'order_id';
        $this->order_type_image		= FALSE;
        $this->order_text_field		= 'name';
        $this->order_image_field	= '';
        $this->order_image_path		= '';
    }

    private function _default(){
        $this->order_by     = array('order_id'=>'asc');
        $this->fields       = [
            [
                'name'=>'name',
                'title'=>'Name',
                'sort'=> TRUE,
                'search'=> 'text'
            ],
            [
                'name'=>'publish',
                'title'=>'Publish',
                'sort'=> TRUE,
                'type'=> 'check'
            ]
        ];
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
                'label'=>'Name'
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
                'label'=>'Name'
            ],
        ];
    }
}