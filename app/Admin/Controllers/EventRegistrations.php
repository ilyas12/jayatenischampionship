<?php

namespace terre\Admin\Controllers;

use terre\Http\Models\EventRegistrationModel;

/**
 * Event registrations — the admin half of the payment flow.
 *
 * Registrations are created by the public form, never here, so the Add button
 * is removed. The only thing an admin does is read the entry, look at the
 * uploaded proof, and set the status.
 */
class EventRegistrations extends ScaffoldController
{
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = "Event Registrations";
        $this->model    = New EventRegistrationModel;
        $this->base_url = '_admin/event_registrations';
    }

    public function index()
    {
        $this->module_name = 'Registration';
        $this->remove_button('add');

        switch ($this->action) {
            case "edit":
                $this->data['sub_title'] = "Review " . $this->module_name;
                $this->_edit();
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

        // Filter above the list, so "show me everyone waiting on me" is one click.
        $this->order_filter = [
            'status' => [
                'title' => 'Status',
                'data'  => ['' => 'All status'] + EventRegistrationModel::statusOptions(),
            ],
        ];

        $this->fields = [
            [
                'name'   => 'code',
                'title'  => 'Code',
                'search' => 'text',
                'sort'   => TRUE,
            ],
            [
                'name'       => 'event_id',
                'title'      => 'Event',
                // Positional: [relation method on the model, field to display].
                'belongs_to' => ['event', 'title'],
            ],
            [
                'name'   => 'name',
                'title'  => 'Name',
                'search' => 'text',
                'sort'   => TRUE,
            ],
            [
                'name'   => 'email',
                'title'  => 'Email',
                'search' => 'text',
            ],
            [
                'name'   => 'amount',
                'title'  => 'Amount',
                'prefix' => 'Rp ',
                'sort'   => TRUE,
            ],
            [
                'name'   => 'status',
                'title'  => 'Status',
                'search' => EventRegistrationModel::statusOptions(),
                'sort'   => TRUE,
                'before_show' => 'showStatus',
            ],
            [
                'name'  => 'payment_proof',
                'title' => 'Proof',
                'before_show' => 'showProof',
            ],
            [
                'name'  => 'created_at',
                'title' => 'Registered',
                'sort'  => TRUE,
            ],
        ];
    }

    /**
     * before_show callbacks. The scaffold resolves these by method name on this
     * controller, so they cannot be closures.
     */
    /** before_save: keep a display-only field out of the UPDATE. */
    public function discardValue($value)
    {
        return '_destroy';
    }

    public function showStatus($value)
    {
        $labels = EventRegistrationModel::statusOptions();

        return isset($labels[$value]) ? $labels[$value] : $value;
    }

    public function showProof($value)
    {
        if (empty($value)) {
            return '-';
        }

        $url = url('resources/assets/uploads/payment_proof/' . $value);

        return '<a href="' . e($url) . '" target="_blank" rel="noopener">View</a>';
    }

    private function _edit()
    {
        $this->fields = [
            // Read-only context so the admin can check the transfer against the
            // entry without leaving the page.
            [
                'name'  => 'summary_html',
                // Not a column. Without discarding it on save the scaffold would
                // assign Input::get('summary_html') (null) onto the model and the
                // UPDATE would fail on an unknown column.
                'before_save' => 'discardValue',
                'label' => 'Registration',
                'type'  => 'plain_text',
            ],
            [
                'name'  => 'proof_html',
                // Not a column. Without discarding it on save the scaffold would
                // assign Input::get('proof_html') (null) onto the model and the
                // UPDATE would fail on an unknown column.
                'before_save' => 'discardValue',
                'label' => 'Payment Proof',
                'type'  => 'plain_text',
            ],
            [
                'name'       => 'status',
                'label'      => 'Status',
                'type'       => 'select',
                'option'     => EventRegistrationModel::statusOptions(),
                'validation' => 'required',
            ],
            [
                'name'   => 'admin_note',
                'label'  => 'Internal Note',
                'type'   => 'textarea',
                'suffix' => 'Not shown to the registrant. Use it to record why an entry was rejected.',
            ],
        ];
    }
}
