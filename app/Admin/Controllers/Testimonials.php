<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/22/2015
 * Time: 4:01 PM
 */
namespace terre\Admin\Controllers;

use Illuminate\Support\Facades\URL;
use terre\Admin\Models\TestimonialsModel;

class Testimonials extends ScaffoldController {

    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = "Testimonials";
        $this->model                = new TestimonialsModel;
    }

    public function index() {
        $this->module_name 	= 'Testimonials';
        $this->base_url 	= '_admin/testimonials';
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
        $this->order_model          = new TestimonialsModel;
        $this->order_field			= 'order_id';
        $this->order_type_image		= TRUE;
        $this->order_text_field		= 'name';
        $this->order_image_field	= 'image';
        $this->order_image_path		= 'resources/assets/uploads/testimonials/';
    }

    private function _default(){
        $this->order_by 	= array('order_id'=>'asc');
        $this->fields = [
            [
                'name'=>'image',
                'title'=>'Image',
                'type'=> 'image',
                'path'=> URL::to('resources/assets/uploads/testimonials/'),
                'width'=> 160
            ],
            [
                'name'=>'name',
                'title'=>'Name',
                'sort'=> TRUE,
                'search'=> 'text'
            ],
            [
                'name'=>'title',
                'title'=>'Title',
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
                'name'=>'image',
                'label'=>'Image',
                'validation'=>'Max:200',
                'type'=>'image',
                'path'=> base_path()."/resources/assets/uploads/testimonials/",
                'file_notes'=>'<br/>For Best Resolution: 555 x 370 px<br>File type:.jpg | .jpeg | .png<br>Max size: 200Kb'
            ],
            [
                'name'=>'name',
                'label'=>'Name',
                'type'=>'text',
                'validation'=>'required'
            ],
            [
                'name'=>'title',
                'label'=>'Title',
                'type'=>'text',
            ],
            [
                'name'=>'location',
                'label'=>'Location',
                'type'=>'text',
            ],
            [
                'name'=>'description',
                'label'=>'Content',
                'type'=>'textarea',
                'validation'=> 'required|Max:200',
                'suffix'=>'<br/>Max : 200 characters'
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
                'value'=> $order_id,
            ]
        ];
    }

    private function _edit(){
        $this->fields 	= [
            [
                'name'=>'image',
                'label'=>'Image',
                'validation'=>'Max:200',
                'type'=>'image',
                'path'=> base_path()."/resources/assets/uploads/testimonials/",
                'file_notes'=>'<br/>For Best Resolution: 555 x 370 px<br>File type:.jpg | .jpeg | .png<br>Max size: 200Kb'
            ],
            [
                'name'=>'name',
                'label'=>'Name',
                'type'=>'text',
                'validation'=>'required'
            ],
            [
                'name'=>'title',
                'label'=>'Title',
                'type'=>'text',
            ],
            [
                'name'=>'location',
                'label'=>'Location',
                'type'=>'text',
            ],
            [
                'name'=>'description',
                'label'=>'Content',
                'type'=>'textarea',
                'validation'=> 'required|Max:200',
                'suffix'=>'<br/>Max : 200 characters'
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