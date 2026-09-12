<?php

namespace terre\Admin\Controllers;

use terre\Http\Models\EventModel;

/**
 * Events — the thing people register for.
 *
 * Reuses terre\Http\Models\EventModel rather than adding a near-identical
 * terre\Admin\Models copy: it is the same table with the same casts, and two
 * models drift.
 */
class Events extends ScaffoldController
{
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = "Events";
        $this->model    = New EventModel;
        $this->base_url = '_admin/events';
    }

    public function index()
    {
        $this->module_name = 'Event';

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

    private function _default()
    {
        $this->order_by = array('id' => 'desc');

        $this->fields = [
            [
                'name'   => 'title',
                'title'  => 'Title',
                'search' => 'text',
                'sort'   => TRUE,
            ],
            [
                'name'   => 'price',
                'title'  => 'Price',
                'sort'   => TRUE,
                'prefix' => 'Rp ',
            ],
            ['name' => 'venue', 'title' => 'Venue', 'sort' => TRUE],
            ['name' => 'phase', 'title' => 'Phase', 'sort' => TRUE],
            [
                'name'  => 'opens_at',
                'title' => 'Opens',
                'sort'  => TRUE,
            ],
            [
                'name'  => 'closes_at',
                'title' => 'Closes',
                'sort'  => TRUE,
            ],
            [
                'name'   => 'publish',
                'title'  => 'Published',
                'search' => [1 => 'Yes', 0 => 'No'],
                'sort'   => TRUE,
                // Reads as Yes/No instead of 1/0. before_show takes a method
                // name on this controller, not a closure.
                'before_show' => 'showYesNo',
            ],
        ];
    }

    /** Add and edit take the same fields; slug is derived from the title. */
    private function _form()
    {
        return [
            [
                'name'       => 'title',
                'label'      => 'Title',
                'validation' => 'required',
                'permalink'  => 'slug',
            ],
            [
                'name'  => 'description',
                'label' => 'Description',
                'type'  => 'tinymce',
            ],
            [
                'name'   => 'venue',
                'label'  => 'Venue',
                'suffix' => 'First line of the venue on the site, e.g. '
                          . '<code>Jakarta</code> or <code>Senayan Courts</code>.',
            ],
            [
                'name'   => 'venue_detail',
                'label'  => 'Venue Detail',
                'suffix' => 'Second line, e.g. <code>Indonesia</code>.',
            ],
            [
                'name'       => 'price',
                'label'      => 'Price (IDR)',
                'validation' => 'nullable|numeric',
                'suffix'     => 'Leave empty for a free event.',
            ],
            [
                'name'   => 'payment_instructions',
                'label'  => 'Payment Instructions',
                'type'   => 'textarea',
                'suffix' => 'Bank account and transfer notes. Shown on the confirmation page and in the payment email.',
            ],
            [
                'name'  => 'opens_at',
                'label' => 'Registration Opens',
                'type'  => 'datepicker',
            ],
            [
                'name'  => 'closes_at',
                'label' => 'Registration Closes',
                'type'  => 'datepicker',
            ],
            [
                'name'       => 'phase',
                'label'      => 'Phase',
                'type'       => 'select',
                'option'     => \terre\Http\Models\EventModel::phaseOptions(),
                'validation' => 'required',
                'suffix'     => 'Drives what the public site shows. Entries are only accepted in Registration, and only while the dates below allow it.',
            ],
            [
                'name'  => 'publish',
                'label' => 'Published',
                'type'   => 'select',
                'option' => [1 => 'Yes', 0 => 'No'],
            ],
        ];
    }

    /** before_show callback: 1/0 -> Yes/No. */
    public function showYesNo($value)
    {
        return $value ? 'Yes' : 'No';
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
