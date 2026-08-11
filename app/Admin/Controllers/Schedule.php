<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/22/2015
 * Time: 4:01 PM
 */
namespace terre\Admin\Controllers;

use Illuminate\Support\Facades\URL;
use terre\Admin\Models\ScheduleModel;
use terre\Admin\Models\TeamProfileModel;

class Schedule extends ScaffoldController {

    public function __construct() {
        parent::__construct();
        $team_id         = \Input::get('team_id');
        $team               = TeamProfileModel::find($team_id);
        $this->data['page_title']   = "Schedule of ".$team->name;
        $this->model                = new ScheduleModel();
    }

    public function index() {
        $team_id         = \Input::get('team_id');
        $team               = TeamProfileModel::find($team_id);
        $this->module_name 	= 'Schedule';
        $this->base_url 	= '_admin/team-profile/schedule?team_id='.$team_id;
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
        $this->add_button('back', URL::to('_admin/team-profile'), '&laquo; Back', array('class'=>'btn btn-default'));


        $this->order_by 	= array('id'=>'asc');
        $this->fields = [

            [
                'name'=>'day',
                'title'=>'Day',
                'sort'=> TRUE
            ],
            [
                'name'=>'open',
                'title'=>'Open',
                'sort'=> TRUE
            ],
            [
                'name'=>'close',
                'title'=>'Close',
                'sort'=> TRUE
            ],
            [
                'name'=>'location',
                'title'=>'Location',
                'sort'=> TRUE
            ],
        ];
    }

    private function _add(){
        $team_id         = \Input::get('team_id');
        $this->fields 	= [
            [
                'name'=>'fkteamid',
                'type'=>'hidden',
                'value'=>$team_id,
            ],
            [
                'name'=>'day',
                'label'=>'Day',
                'type'=>'select',
                'option'=>array(''=>'Choose', 'Monday'=>'Monday', 'Tuesday'=>'Tuesday', 'Wednesday'=>'Wednesday', 'Thursday'=>'Thursday', 'Friday'=>'Friday', 'Saturday'=>'Saturday', 'Sunday'=>'Sunday'),
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