<?php

namespace terre\Admin\Controllers;

use terre\Http\Models\EventCategoryModel;
use terre\Http\Models\EventModel;

class EventCategories extends ScaffoldController
{
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = "Event Categories";
        $this->model    = New EventCategoryModel;
        $this->base_url = '_admin/event_categories';
    }

    public function index()
    {
        $this->module_name = 'Category';

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
        $this->order_by = array('order_id' => 'asc');

        $this->order_filter = [
            'event_id' => [
                'title' => 'Event',
                'data'  => ['' => 'All events'] + $this->eventOptions(),
            ],
        ];

        $this->fields = [
            ['name' => 'order_id', 'title' => '#', 'sort' => TRUE, 'width' => 60],
            [
                'name'       => 'event_id',
                'title'      => 'Event',
                'belongs_to' => ['event', 'title'],
            ],
            ['name' => 'code', 'title' => 'Code', 'search' => 'text'],
            ['name' => 'name', 'title' => 'Draw', 'search' => 'text', 'sort' => TRUE],
            ['name' => 'draw_size', 'title' => 'Draw Size'],
            ['name' => 'status_label', 'title' => 'Status'],
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
            [
                'name'       => 'code',
                'label'      => 'Code',
                'validation' => 'required',
                'suffix'     => 'Value the registration form posts, e.g. <code>ms</code>. Must be unique within the event, and changing it orphans existing entries.',
            ],
            ['name' => 'name', 'label' => 'Draw Name', 'validation' => 'required'],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea'],
            ['name' => 'draw_size', 'label' => 'Draw Size', 'validation' => 'nullable|integer'],
            [
                'name'   => 'status_label',
                'label'  => 'Status Label',
                'suffix' => 'Shown beside the draw size, e.g. <code>Open</code> or <code>4 places left</code>.',
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
