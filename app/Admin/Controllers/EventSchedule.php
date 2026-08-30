<?php

namespace terre\Admin\Controllers;

use terre\Http\Models\EventModel;
use terre\Http\Models\EventScheduleModel;

class EventSchedule extends ScaffoldController
{
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = "Event Schedule";
        $this->model    = New EventScheduleModel;
        $this->base_url = '_admin/event_schedule';
    }

    public function index()
    {
        $this->module_name = 'Schedule Entry';

        switch ($this->action) {
            case "edit":
                $this->data['sub_title'] = "Edit " . $this->module_name;
                $this->_edit();
                break;
            case "add":
                $this->data['sub_title'] = "Add " . $this->module_name;
                $this->_add();
                break;
            default:
                $this->data['sub_title'] = "List " . $this->module_name;
                $this->_default();
                break;
        }

        return $this->build();
    }

    protected function eventOptions()
    {
        return EventModel::orderBy('title')->pluck('title', 'id')->toArray();
    }

    private function _default()
    {
        $this->order_by = array('starts_on' => 'asc');

        $this->order_filter = [
            'event_id' => [
                'title' => 'Event',
                'data'  => ['' => 'All events'] + $this->eventOptions(),
            ],
        ];

        $this->fields = [
            ['name' => 'starts_on', 'title' => 'Date', 'sort' => TRUE],
            [
                'name'       => 'event_id',
                'title'      => 'Event',
                'belongs_to' => ['event', 'title'],
            ],
            ['name' => 'title', 'title' => 'Session', 'search' => 'text', 'sort' => TRUE],
            ['name' => 'detail', 'title' => 'Detail'],
            ['name' => 'note', 'title' => 'Note'],
            ['name' => 'publish', 'title' => 'Publish', 'type' => 'check', 'sort' => TRUE],
        ];
    }

    private function _form()
    {
        return [
            [
                'name'       => 'event_id',
                'label'      => 'Event',
                'type'       => 'select',
                'option'     => $this->eventOptions(),
                'validation' => 'required',
            ],
            ['name' => 'starts_on', 'label' => 'Date', 'type' => 'datepicker'],
            ['name' => 'title', 'label' => 'Session', 'validation' => 'required'],
            [
                'name'   => 'detail',
                'label'  => 'Detail',
                'suffix' => 'Courts and times as one line, e.g. <code>Centre &amp; Court 1 &middot; 10:00</code>.',
            ],
            [
                'name'   => 'note',
                'label'  => 'Note',
                'suffix' => 'Short label on the right, e.g. <code>Ticketed</code> or <code>Sold out</code>.',
            ],
            ['name' => 'order_id', 'label' => 'Order', 'validation' => 'nullable|integer'],
            [
                'name'   => 'publish',
                'label'  => 'Publish',
                'type'   => 'select',
                'option' => [1 => 'Yes', 0 => 'No'],
            ],
        ];
    }

    private function _add() { $this->fields = $this->_form(); }
    private function _edit() { $this->fields = $this->_form(); }
}
