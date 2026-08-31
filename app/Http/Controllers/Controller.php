<?php

namespace terre\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use terre\Systems\Controllers\Static_Content;
use terre\Systems\Controllers\Systems;

abstract class Controller extends BaseController {

    use DispatchesJobs, ValidatesRequests;
    public $config;
    public $content;
    public $data;
    public $configType  = 'front';
    public $reset       = true;

    public function __construct() {
        $this->_start_up(Systems::load_config($this->configType, $this->reset));
        $this->_start_up(Static_Content::load_content($this->reset));

        if(Systems::get($this->configType, 'maintenance_mode')) {
            return view('errors.503');
            exit;
        }
    }

    public function _start_up($config) {
        foreach($config as $key => $conf)
            $this->data[$key] = $conf;
    }

    public function render_view($name) {
        return view($name, $this->data);
    }
}
