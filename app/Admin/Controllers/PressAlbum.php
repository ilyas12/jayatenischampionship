<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/22/2015
 * Time: 4:01 PM
 */
namespace terre\Admin\Controllers;

use terre\Libraries\Input;
use Illuminate\Support\Facades\URL;
use terre\Admin\Models\PressAlbumModel;
use terre\Admin\Models\PressModel;
use terre\Admin\Models\TeamProfileModel;

class PressAlbum extends ScaffoldController {

    public function __construct() {
        parent::__construct();
        $press_id         = \Input::get('press_id');
        $press               = PressModel::find($press_id);
        $this->data['page_title']   = "Album of ".$press->title;
        $this->model                = new PressAlbumModel();
    }

    public function index() {
        $press_id           = Input::get('press_id');
        $this->module_name 	= 'Press Album';
        $this->base_url 	= '_admin/press/album?press_id='.$press_id;
        $this->set('manage_order', false);
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
        $this->order_by 	= array('id'=>'asc');
        $this->fields = [
            [
                'name'=>'image',
                'title'=>'Image',
                'type'=> 'image',
                'path'=> URL::to('resources/assets/uploads/home_press_awards/'),
                'width'=> 160
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
        $press_id       = \Input::get('press_id');
        $this->fields 	= [
            [
                'name'=>'fkpressid',
                'type'=>'hidden',
                'value'=>$press_id,
            ],
            [
                'name'=>'image',
                'label'=>'Image ',
                'validation'=>'required',
                'type'=>'file',
                'path'=> base_path()."/resources/assets/uploads/home_press_awards/",
                'file_notes'=>'For Best Resolution: ? x ? px<br>File type:.jpg | .jpeg | .png<br>Max size: 200Kb'
            ],
        ];
    }

    private function _edit(){
        $this->fields 	= [
            [
                'name'=>'day',
                'label'=>'Day',
                'type'=>'text',
                'validation'=>'required',
            ],
            [
                'name'=>'open',
                'label'=>'Open',
                'type'=>'text',
                'validation'=>'required',
            ],
            [
                'name'=>'close',
                'label'=>'Close',
                'type'=>'text',
                'validation'=>'required',
            ],
            [
                'name'=>'location',
                'label'=>'Location',
                'type'=>'text',
            ],
        ];
    }

}