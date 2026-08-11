<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/22/2015
 * Time: 4:01 PM
 */
namespace terre\Admin\Controllers;

use Illuminate\Support\Facades\URL;
use terre\Admin\Models\TeamProfileModel;

class TeamProfile extends ScaffoldController {

    public function __construct() {
        parent::__construct();
        $this->data['page_title']   = "Team Profile";
        $this->model                = new TeamProfileModel;
        $this->file_path            = base_path().'/resources/assets/uploads/team_profile/';
    }

    public function index() {
        $this->module_name 	= 'Team Profile';
        $this->base_url 	= '_admin/team-profile';
        $this->set('manage_order', true);
        $this->set('delete_file', 'img');
        $this->set('delete_path', array(base_path().'/resources/assets/uploads/team_profile/'));

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
        $this->order_model          = new TeamProfileModel;
        $this->order_field			= 'order_id';
        $this->order_type_image		= TRUE;
        $this->order_text_field		= 'name';
        $this->order_image_field	= 'img';
        $this->order_image_path		= 'resources/assets/uploads/team_profile/';
    }

    private function _default(){
        $this->add_action_button('Schedule', URL::to('_admin/team-profile/schedule?team_id='."{".$this->table_id."}"), '<i class="fa fa-calendar"></i>', array('class'=>'btn btn-xs btn-info'));
        //$this->add_action_button('Schedule', URL::to('_admin/team-profile-schedule?'."act=download&id="."{".$this->table_id."}"), '<i class="fa fa-download"></i>', array('class'=>'btn btn-xs btn-success'));
        $this->order_by 	= array('order_id'=>'asc');
        $this->fields = [
            [
                'name'=>'img',
                'title'=>'Thumbnail',
                'type'=> 'image',
                'path'=> URL::to('resources/assets/uploads/team_profile/'),
                'width'=> 160
            ],
            [
                'name'=>'name',
                'title'=>'Name',
                'sort'=> TRUE
            ],
            [
                'name'=>'position',
                'title'=>'Position',
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
                'label'=>'Profile Picture',
                'validation'=>'required',
                'type'=>'image',
                'path'=> base_path()."/resources/assets/uploads/team_profile/",
                'file_notes'=>'For Best Resolution: ? x ? px<br>File type:.jpg | .jpeg | .png<br>Max size: 200Kb'
            ],
            [
                'name'=>'name',
                'label'=>'Name',
                'type'=>'text',
                'validation'=>'required',
                'permalink'=>'permalink',
            ],
            [
                'name'=>'position',
                'label'=>'Position',
                'type'=>'text',
            ],
            [
                'name'=>'description',
                'label'=>'Description',
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
        $this->fields 	= [
            [
                'name'=>'img',
                'label'=>'Profile Picture',
                'type'=>'image',
                'path'=> base_path()."/resources/assets/uploads/team_profile/",
                'file_notes'=>'For Best Resolution: ? x ? px<br>File type:.jpg | .jpeg | .png<br>Max size: 200Kb'
            ],
            [
                'name'=>'name',
                'label'=>'Name',
                'type'=>'text',
                'validation'=>'required',
                'permalink'=>'permalink',
            ],
            [
                'name'=>'position',
                'label'=>'Position',
                'type'=>'text',
            ],
            [
                'name'=>'description',
                'label'=>'Description',
                'type'=>'tinymce',
                'validation'=> 'required'
            ],
        ];
    }

}