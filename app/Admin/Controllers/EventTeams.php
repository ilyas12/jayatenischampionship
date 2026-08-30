<?php

namespace terre\Admin\Controllers;

use terre\Http\Models\EventModel;
use terre\Http\Models\EventTeamModel;

class EventTeams extends ScaffoldController
{
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = "Event Teams";
        $this->model    = New EventTeamModel;
        $this->base_url = '_admin/event_teams';
    }

    public function index()
    {
        $this->module_name = 'Team';

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

    /** Events for the picker; a team always belongs to one. */
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
            [
                'name'  => 'photo',
                'title' => 'Photo',
                'type'  => 'image',
                'path'  => url('resources/assets/uploads/event_teams/'),
                'width' => 120,
            ],
            [
                'name'       => 'event_id',
                'title'      => 'Event',
                'belongs_to' => ['event', 'title'],
            ],
            [
                'name'   => 'name',
                'title'  => 'Team',
                'search' => 'text',
                'sort'   => TRUE,
            ],
            ['name' => 'short_code', 'title' => 'Code'],
            ['name' => 'city', 'title' => 'City', 'search' => 'text'],
            ['name' => 'seed', 'title' => 'Seed', 'sort' => TRUE],
            ['name' => 'team_group', 'title' => 'Group', 'sort' => TRUE],
            [
                'name'  => 'publish',
                'title' => 'Publish',
                'type'  => 'check',
                'sort'  => TRUE,
            ],
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
                'name'       => 'name',
                'label'      => 'Team Name',
                'validation' => 'required',
                'permalink'  => 'permalink',
            ],
            [
                'name'   => 'short_code',
                'label'  => 'Short Code',
                'suffix' => 'Up to 4 letters. Shown on the crest, and picks the placeholder image (SRC uses src.svg).',
            ],
            ['name' => 'city', 'label' => 'City'],
            ['name' => 'founded', 'label' => 'Founded', 'validation' => 'nullable|integer'],
            [
                'name'  => 'photo',
                'label' => 'Squad Photo',
                'type'  => 'image',
                'path'  => base_path('resources/assets/uploads/event_teams/'),
                'suffix' => 'Optional. Falls back to the placeholder crest.',
            ],
            ['name' => 'seed', 'label' => 'Seed', 'validation' => 'nullable|integer'],
            [
                'name'   => 'team_group',
                'label'  => 'Group',
                'suffix' => 'Pool letter, e.g. A or B. Drives the filter buttons on the teams page.',
            ],
            [
                'name'   => 'qualified',
                'label'  => 'Qualified',
                'type'   => 'select',
                'option' => [1 => 'Yes', 0 => 'No'],
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

    private function _add()
    {
        $this->fields = $this->_form();
    }

    private function _edit()
    {
        $this->fields = $this->_form();
    }
}
