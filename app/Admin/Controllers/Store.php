<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/25/2015
 * Time: 9:06 AM
 */
namespace terre\Admin\Controllers;

use Illuminate\Support\Facades\URL;
use terre\Admin\Models\StoreModel;

class Store extends ScaffoldController {

    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = "Stores";
        $this->model                = new StoreModel;
    }

    public function index() {
        $this->module_name  = 'Stores';
        $this->base_url     = '/stores';
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

    private function _default(){
        $this->set('delete_file', 'img');
        $this->set('delete_path', array(base_path().'/resources/assets/uploads/stores/'));
        $this->order_by     = array('order_id'=>'asc');
        $this->fields = [
            [
                'name'=>'img',
                'title'=>'Image',
                'type'=> 'image',
                'path'=> URL::to('resources/assets/uploads/stores/'),
                'width'=> 160
            ],
            [
                'name'=>'name',
                'title'=>'Name',
                'sort'=> TRUE,
                'search'=> 'text'
            ],
            [
                'name'=>'region',
                'title'=>'Region',
                'sort'=> TRUE,
                'type'=>'custom',
                'before_show'=>'_get_region',
            ],
            [
                'name'=>'publish',
                'title'=>'Publish',
                'sort'=> TRUE,
                'type'=>'check'
            ]
        ];
    }

    private function _order(){
        $this->order_model          = new StoreModel;
        $this->order_field			= 'order_id';
        $this->order_type_image		= TRUE;
        $this->order_text_field		= 'name';
        $this->order_image_field	= 'img';
        $this->order_image_path		= 'resources/assets/uploads/stores/';
    }
    
    protected  function _get_region($data) {
        if ( $data->region == 1 ) {
            $type = 'Jakarta';
        } else if ( $data->region == 2 ) {
            $type = 'Surabaya';
        } else {
            $type = 'Not Selected';
        }
        return $type;
    }


    private function _add(){
        $order_id = $this->model->orderBy('order_id', 'DESC')->first();
        if ( !empty($order_id) ) {
            $order_id   = $order_id->order_id + 1;
        } else {
            $order_id   = 1;
        }
        $this->fields   = [
            [
                'name'=>'img',
                'label'=>'Image ',
                'validation'=>'required|Max:500',
                'type'=>'file',
                'path'=> base_path()."/resources/assets/uploads/stores/",
                'file_notes'=>'For Best Resolution: 1280 x 487 px<br>File type:.jpg | .jpeg | .png<br>Max size: 500Kb'
            ],
            [
                'name'=>'img_2',
                'label'=>'Image 2',
                'validation'=>'required|Max:500',
                'type'=>'file',
                'path'=> base_path()."/resources/assets/uploads/stores/",
                'file_notes'=>'For Best Resolution: 370 x 277 px<br>File type:.jpg | .jpeg | .png<br>Max size: 500Kb'
            ],
            [
                'name'=>'region',
                'label'=>'Region',
                'validation'=> 'required',
                'type'=>'select',
                'option'=>array(''=>'Choose', '1'=>'Jakarta', '2'=>'Surabaya')
            ],
            [
                'name'=>'name',
                'label'=>'Name',
                'type'=>'text',
                'validation'=>'required',
            ],
            [
                'name'=>'office_phone_number',
                'label'=>'Office Phone Number',
                'type'=>'text'
            ],
            [
                'name'=>'whatsapp_number',
                'label'=>'Whatsapp Number',
                'type'=>'text'
            ],
            [
                'name'=>'call_number_one',
                'label'=>'Customer Service One',
                'type'=>'text'
            ],
            [
                'name'=>'call_number_two',
                'label'=>'Customer Service Two',
                'type'=>'text'
            ],
            [
                'name'=>'latitude',
                'label'=>'Latitude',
                'type'=>'text',
                'validation'=>'required',
            ],
            [
                'name'=>'longitude',
                'label'=>'Longitude',
                'type'=>'text',
                'validation'=>'required',
            ],
            [
                'name'=>'maps_url',
                'label'=>'Maps URL',
                'type'=>'text',
                'validation'=>'required',
            ],
			[
                'name'=>'description',
                'label'=>'Content',
                'type'=>'tinymce',
                'validation'=> 'required'
            ],
            [
                'name'=>'order_id',
                'type'=>'hidden',
                'value'=>$order_id,
            ],
        ];
    }

    private function _edit(){
        $this->fields   = [
            [
                'name'=>'img',
                'label'=>'Image 1',
                'validation'=>'Max:500',
                'type'=>'file',
                'path'=> base_path()."/resources/assets/uploads/stores/",
                'file_notes'=>'For Best Resolution: 1280 x 487 px<br>File type:.jpg | .jpeg | .png<br>Max size: 500Kb'
            ],
            [
                'name'=>'img_2',
                'label'=>'Image 2',
                'validation'=>'Max:500',
                'type'=>'file',
                'path'=> base_path()."/resources/assets/uploads/stores/",
                'file_notes'=>'For Best Resolution: 370 x 277 px<br>File type:.jpg | .jpeg | .png<br>Max size: 500Kb'
            ],
            [
                'name'=>'region',
                'label'=>'Region',
                'validation'=> 'required',
                'type'=>'select',
                'option'=>array(''=>'Choose', '1'=>'Jakarta', '2'=>'Surabaya')
            ],
            [
                'name'=>'name',
                'label'=>'Name',
                'type'=>'text',
                'validation'=>'required',
            ],
            [
                'name'=>'office_phone_number',
                'label'=>'Office Phone Number',
                'type'=>'text'
            ],
            [
                'name'=>'whatsapp_number',
                'label'=>'Whatsapp Number',
                'type'=>'text'
            ],
            [
                'name'=>'call_number_one',
                'label'=>'Customer Service One',
                'type'=>'text'
            ],
            [
                'name'=>'call_number_two',
                'label'=>'Customer Service Two',
                'type'=>'text'
            ],
            [
                'name'=>'latitude',
                'label'=>'Latitude',
                'type'=>'text',
                'validation'=>'required',
            ],
            [
                'name'=>'longitude',
                'label'=>'Longitude',
                'type'=>'text',
                'validation'=>'required',
            ],
            [
                'name'=>'maps_url',
                'label'=>'Maps URL',
                'type'=>'text',
                'validation'=>'required',
            ],
            [
                'name'=>'description',
                'label'=>'Content',
                'type'=>'tinymce',
                'validation'=> 'required'
            ],
        ];
    }
}