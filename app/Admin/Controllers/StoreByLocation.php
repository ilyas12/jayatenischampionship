<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/25/2015
 * Time: 9:06 AM
 */
namespace terre\Admin\Controllers;

use Illuminate\Support\Facades\URL;
use terre\Admin\Models\LocationModel;
use terre\Admin\Models\StoreByLocationModel;

class StoreByLocation extends ScaffoldController {

    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = "Stores";
        $this->model                = new StoreByLocationModel;
    }

    public function index() {
        $this->module_name  = 'Stores by Location';
        $this->base_url     = '_admin/stores-by-location';
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
                'name'=>'fklocationid',
                'title'=>'Location',
                'sort'=> TRUE,
                'belongs_to'=> array('location', 'name'),       //--array('function di model', '1 field tabel / *', 'callback')
                'search'=> $this->_get_location()
            ],
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
                'name'=>'publish',
                'title'=>'Publish',
                'sort'=> TRUE,
                'type'=>'check'
            ]
        ];
    }

    private function _order(){
        $this->order_model          = new StoreByLocationModel;
        $this->order_field			= 'order_id';
        $this->order_type_image		= TRUE;
        $this->order_text_field		= 'name';
        $this->order_image_field	= 'img';
        $this->order_image_path		= 'resources/assets/uploads/stores/';
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
                'validation'=>'required',
                'type'=>'file',
                'path'=> base_path()."/resources/assets/uploads/stores/",
                'file_notes'=>'For Best Resolution: ? x ? px<br>File type:.jpg | .jpeg | .png<br>Max size: 2Mb'
            ],
            [  'name'=>'fklocationid',
                'label'=>'Location',
                'type'=>'select',
                'option'=>$this->_get_location(),
                'validation'=>'required'
            ],
            [
                'name'=>'name',
                'label'=>'Name',
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
                'name'=>'longitude',
                'label'=>'Longitude',
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

    private function _get_location(){
        $model = New LocationModel;
        $all = $model->all();
        $data['']               = "Choose";
        foreach($all as $prov){
            $data[$prov->id]    = $prov['name'];
        }
        return $data;
    }

    private function _edit(){
        $this->fields   = [
            [
                'name'=>'img',
                'label'=>'Image ',
                'type'=>'file',
                'path'=> base_path()."/resources/assets/uploads/stores/",
                'file_notes'=>'For Best Resolution: ? x ? px<br>File type:.jpg | .jpeg | .png<br>Max size: 2Mb'
            ],
            [  'name'=>'fklocationid',
                'label'=>'Location',
                'type'=>'select',
                'option'=>$this->_get_location(),
                'validation'=>'required'
            ],
            [
                'name'=>'name',
                'label'=>'Name',
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
                'name'=>'longitude',
                'label'=>'Longitude',
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