<?php

namespace terre\Admin\Controllers;

use terre\Http\Models\EventMatchModel;
use terre\Http\Models\EventModel;
use terre\Http\Models\EventTeamModel;

class EventMatches extends ScaffoldController
{
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = "Draw";
        $this->model    = New EventMatchModel;
        $this->base_url = '_admin/event_matches';
    }

    public function index()
    {
        $this->module_name = 'Match';

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

    /** Teams to pick from. Blank first so a slot can stay undecided. */
    protected function teamOptions()
    {
        return ['' => '— to be decided —']
            + EventTeamModel::orderBy('name')->pluck('name', 'id')->toArray();
    }

    private function _default()
    {
        $this->order_by = array('round' => 'asc');

        $this->order_filter = [
            'event_id' => [
                'title' => 'Event',
                'data'  => ['' => 'All events'] + $this->eventOptions(),
            ],
        ];

        $this->fields = [
            ['name' => 'round', 'title' => 'Round', 'sort' => TRUE],
            ['name' => 'round_name', 'title' => 'Name', 'sort' => TRUE],
            ['name' => 'label', 'title' => 'Match'],
            [
                'name'       => 'home_team_id',
                'title'      => 'Home',
                'belongs_to' => ['home', 'name'],
            ],
            [
                'name'       => 'away_team_id',
                'title'      => 'Away',
                'belongs_to' => ['away', 'name'],
            ],
            [
                'name'       => 'winner_team_id',
                'title'      => 'Winner',
                'belongs_to' => ['winner', 'name'],
            ],
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
                'name'       => 'round',
                'label'      => 'Round Number',
                'validation' => 'required|integer|min:1',
                'suffix'     => 'Column order, left to right. 1 is the first round shown.',
            ],
            [
                'name'   => 'round_name',
                'label'  => 'Round Name',
                'suffix' => 'Heading above the column, e.g. <code>Quarter-finals</code>.',
            ],
            ['name' => 'label', 'label' => 'Match Label', 'suffix' => 'e.g. <code>QF 1</code>.'],
            ['name' => 'meta', 'label' => 'When / Where', 'suffix' => 'Shown on the draw, e.g. <code>Fri &middot; Centre</code>.'],
            ['name' => 'court', 'label' => 'Court', 'suffix' => 'Court column on the results board, e.g. <code>Centre</code>.'],
            [
                'name'   => 'home_team_id',
                'label'  => 'Home Team',
                'type'   => 'select',
                'option' => $this->teamOptions(),
            ],
            ['name' => 'home_score', 'label' => 'Home Score', 'suffix' => 'Sets as written, e.g. <code>6 6</code>.'],
            [
                'name'   => 'away_team_id',
                'label'  => 'Away Team',
                'type'   => 'select',
                'option' => $this->teamOptions(),
            ],
            ['name' => 'away_score', 'label' => 'Away Score'],
            [
                'name'   => 'winner_team_id',
                'label'  => 'Winner',
                'type'   => 'select',
                'option' => $this->teamOptions(),
                'suffix' => 'Leave undecided until the tie is played. The champion shown on the draw is the winner of the last round.',
            ],
            ['name' => 'order_id', 'label' => 'Order in Round', 'validation' => 'nullable|integer'],
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
