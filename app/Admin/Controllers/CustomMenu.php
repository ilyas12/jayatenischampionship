<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/26/2015
 * Time: 12:55 AM
 */
namespace terre\Admin\Controllers;


use terre\Admin\Models\CustomMenuModel;

class CustomMenu extends ScaffoldController {
    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = "Custom Menu";
        $this->model                = new CustomMenuModel;
        $this->base_url 	        = '_admin/custom-menu';
    }

    public function index() {
        $this->module_name 	= 'Custom Menu';
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
        $this->remove_button('add');
        $this->order_by 	= array('order_id'=>'asc');
        $this->fields = [
            [
                'name'=>'custom_name',
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

    private function _order(){
        $this->order_model          = new CustomMenuModel;
        $this->order_field			= 'order_id';
        $this->order_type_image		= FALSE;
        $this->order_text_field		= 'custom_name';
        $this->order_image_field	= '';
        $this->order_image_path		= '';
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
                'name'=>'custom_name',
                'label'=>'Custom Menu Name',
                'validation'=> 'required',
            ],
            [
                'name'=>'permalink',
                'label'=>'Menu',
                'validation'=> 'required|unique:custom_menu',
                'type'=>'select',
                'option'=>array(''=>'Choose', 'home'=>'Home', 'brand'=>'Brand', 'products'=>'Products', 'projects'=>'Projects', 'news_and_events'=>'News And Events', 'testimonials'=>'Testimonials', 'stores'=>'Stores', 'about'=>'About', 'contact'=>'Contact'),
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
                'name'=>'menu',
                'label'=>'Menu',
                'type'=>'plain_text',
            ],
            [
                'name'=>'custom_name',
                'label'=>'Custom Menu Name',
                'type'=>'text',
                'validation'=> 'required',
            ],
        ];
    }

}