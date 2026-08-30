<?php

namespace terre\Admin\Controllers;

use terre\Http\Models\EventTeamMemberModel;
use terre\Http\Models\EventTeamModel;

class EventTeamMembers extends ScaffoldController
{
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = "Team Players";
        $this->model    = New EventTeamMemberModel;
        $this->base_url = '_admin/event_team_members';
    }

    public function index()
    {
        $this->module_name = 'Player';

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

    /** Teams to attach a player to, labelled with their event. */
    protected function teamOptions()
    {
        $options = [];

        foreach (EventTeamModel::with('event')->orderBy('name')->get() as $team) {
            $options[$team->id] = optional($team->event)->title . ' — ' . $team->name;
        }

        return $options;
    }

    private function _default()
    {
        $this->order_by = array('team_id' => 'asc');

        $this->order_filter = [
            'team_id' => [
                'title' => 'Team',
                'data'  => ['' => 'All teams'] + $this->teamOptions(),
            ],
        ];

        $this->fields = [
            [
                'name'  => 'photo',
                'title' => 'Photo',
                'type'  => 'image',
                'path'  => url('resources/assets/uploads/event_team_members/'),
                'width' => 70,
            ],
            [
                'name'       => 'team_id',
                'title'      => 'Team',
                'belongs_to' => ['team', 'name'],
            ],
            ['name' => 'name', 'title' => 'Player', 'search' => 'text', 'sort' => TRUE],
            ['name' => 'role', 'title' => 'Role', 'sort' => TRUE],
            ['name' => 'rank', 'title' => 'Rank'],
            ['name' => 'publish', 'title' => 'Publish', 'type' => 'check', 'sort' => TRUE],
        ];
    }

    private function _form()
    {
        return [
            [
                'name'       => 'team_id',
                'label'      => 'Team',
                'type'       => 'select',
                'option'     => $this->teamOptions(),
                'validation' => 'required',
            ],
            [
                'name'       => 'name',
                'label'      => 'Player Name',
                'validation' => 'required',
                'suffix'     => 'A paid registration re-syncs players by name, so renaming one here creates a second row on the next sync.',
            ],
            [
                'name'  => 'photo',
                'label' => 'Portrait',
                'type'  => 'image',
                'path'  => base_path('resources/assets/uploads/event_team_members/'),
                'suffix' => 'Optional. Square crops best; initials are shown when there is no photo.',
            ],
            ['name' => 'role', 'label' => 'Role', 'suffix' => 'Captain, Player, Reserve, Coach.'],
            ['name' => 'rank', 'label' => 'Rank', 'suffix' => 'National ranking, shown as #12.'],
            [
                'name'   => 'bio',
                'label'  => 'Short Description',
                'type'   => 'textarea',
                'suffix' => 'One or two lines about the player. Omitted from the card when empty.',
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
