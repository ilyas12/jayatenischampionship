<?php

namespace terre\Admin\Controllers;

use terre\Http\Models\EventModel;
use terre\Http\Models\EventPartnerModel;

class EventPartners extends ScaffoldController
{
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = "Event Partners";
        $this->model    = New EventPartnerModel;
        $this->base_url = '_admin/event_partners';
    }

    public function index()
    {
        $this->module_name = 'Partner';

        // Removing a partner should take its logo with it, or the upload
        // directory fills with files nothing points at.
        $this->set('delete_file', 'logo');
        $this->set('delete_path', array(base_path() . '/resources/assets/uploads/event_partners/'));

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
            ['name' => 'logo', 'title' => 'Logo', 'type' => 'image', 'path' => 'resources/assets/uploads/event_partners/'],
            ['name' => 'name', 'title' => 'Partner', 'search' => 'text', 'sort' => TRUE],
            ['name' => 'url', 'title' => 'Link'],
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
            ['name' => 'name', 'label' => 'Partner Name', 'validation' => 'required'],
            [
                'name'       => 'logo',
                'label'      => 'Logo',
                'type'       => 'file',
                'path'       => base_path() . "/resources/assets/uploads/event_partners/",
                'file_notes' => 'The strip renders every logo at the same height and in '
                              . 'greyscale until hovered.<br>Best on a transparent background, '
                              . 'around 250 x 100 px.<br>File type: .jpg | .jpeg | .png',
            ],
            [
                'name'       => 'url',
                'label'      => 'Link',
                'validation' => 'nullable|url',
                'suffix'     => 'Optional. With one the logo links out in a new tab; without, it is just artwork.',
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
