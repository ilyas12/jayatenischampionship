<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/23/2015
 * Time: 1:35 PM
 */
namespace terre\Admin\Controllers;

use Illuminate\Support\Facades\URL;
use terre\Admin\Models\ContactAddressModel;

class ContactAddress extends ScaffoldController {

    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = "Contact Address";
        $this->model                = new ContactAddressModel;
    }

    public function index() {
        $this->module_name 	= 'Contact Address';
        $this->base_url 	= '_admin/contact_address';
        $this->set('manage_order', true);
        $this->set('delete_file', 'image');
        $this->set('delete_path', array(base_path().'/resources/assets/uploads/contact/'));

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
        $this->order_model          = new ContactAddressModel;
        $this->order_field			= 'order_id';
        $this->order_type_image		= TRUE;
        $this->order_text_field		= 'name';
        $this->order_image_field	= 'img';
        $this->order_image_path		= 'resources/assets/uploads/contact/';
    }

    private function _default(){
        $this->order_by 	= array('order_id'=>'asc');
        $this->fields = [
            [
                'name'=>'img',
                'title'=>'Image',
                'type'=> 'image',
                'path'=> URL::to('resources/assets/uploads/contact/'),
                'width'=> 160
            ],
            [
                'name'=>'name',
                'title'=>'Name',
                'sort'=> TRUE
            ],
            [
                'name'=>'longitude',
                'title'=>'Longitude',
                'sort'=> TRUE
            ],
            [
                'name'=>'latitude',
                'title'=>'Latitude',
                'sort'=> TRUE
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
                'name'=>'img',
                'label'=>'Image ',
                'validation'=>'required',
                'type'=>'file',
                'path'=> base_path()."/resources/assets/uploads/contact/",
                'file_notes'=>'For Best Resolution: 1600 x 620 px<br>File type:.jpg | .jpeg | .png<br>Max size: 200Kb'
            ],
            [
                'name'=>'name',
                'label'=>'Name',
                'type'=>'text',
                'validation'=>'required',
            ],
            [
                'name'=>'address',
                'label'=>'Address',
                'type'=>'tinymce',
                'validation'=> 'required'
            ],
            [
                'name'=>'longitude',
                'label'=>'Longitude',
                'type'=>'text',
                'validation'=>'required',
            ],
            [
                'name'=>'latitude',
                'label'=>'Latitude',
                'type'=>'text',
                'validation'=>'required',
            ],
            [
                'name'=>'publish',
                'label'=>'Publish',
                'type'=>'radio',
                'option'=>array('1'=>'Yes', '0'=>'No'),
                'validation'=>'required'
            ],
            [
                'name'=>'order_id',
                'type'=>'hidden',
                'value'=>$order_id,
            ],
        ];
    }

    private function _edit(){
        $this->fields 	= [
            [
                'name'=>'img',
                'label'=>'Image ',
                'type'=>'file',
                'path'=> base_path()."/resources/assets/uploads/contact/",
                'file_notes'=>'For Best Resolution: 1600 x 620 px<br>File type:.jpg | .jpeg | .png<br>Max size: 200Kb'
            ],
            [
                'name'=>'name',
                'label'=>'Name',
                'type'=>'text',
                'validation'=>'required',
            ],
            [
                'name'=>'address',
                'label'=>'Address',
                'type'=>'tinymce',
                'validation'=> 'required'
            ],
            [
                'name'=>'longitude',
                'label'=>'Longitude',
                'type'=>'text',
                'validation'=>'required',
            ],
            [
                'name'=>'latitude',
                'label'=>'Latitude',
                'type'=>'text',
                'validation'=>'required',
            ],
            [
                'name'=>'publish',
                'label'=>'Publish',
                'type'=>'radio',
                'option'=>array('1'=>'Yes', '0'=>'No'),
                'validation'=>'required'
            ],
        ];
    }

}