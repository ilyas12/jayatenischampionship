<?php

namespace terre\Admin\Controllers;

use terre\Admin\Models\AboutModel;
use terre\Admin\Models\CategoryModel;

class AboutByCategory extends ScaffoldController {

    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = "About";
        $this->model                = new AboutModel;
    }
    public function index() {
        $this->module_name 	= 'About';
        $this->base_url 	= '_admin/about-by-category';
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

    private function _getcategory(){
        $model = new CategoryModel();
        $all = $model->all();
        $data['']       = "Choose";
        foreach($all as $prov){
            $data[$prov->id] = $prov['name'];
        }
        return $data;
    }

    private function _default(){
        $this->remove_button('order');
        $this->order_by     = array('order_id'=>'asc');
        $this->fields       = [
            [
                'name' => 'fkaboutcategoryid',
                'title' => 'Category',
                'sort' => TRUE,
                'belongs_to' => ['category', 'name'],
                'search' => $this->_getcategory()
            ],
            [
                'name' => 'publish',
                'title' => 'Publish',
                'sort' => TRUE,
                'type' => 'check'
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
            [  'name'=>'fkaboutcategoryid',
                'label'=>'Category',
                'type'=>'select',
                'option'=>$this->_getcategory(),
                'validation'=>'required'
            ],
            [
                'name'=>'description',
                'label'=>'Description',
                'type'=>'tinymce',
                'group'=>'test',
                'validation'=>'required'
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
            [  'name'=>'fkaboutcategoryid',
                'label'=>'Category',
                'type'=>'select',
                'option'=>$this->_getcategory(),
                'validation'=>'required'
            ],
            [
                'name'=>'description',
                'label'=>'Description',
                'type'=>'tinymce',
                'group'=>'test',
                'validation'=>'required'
            ],
        ];
    }
}