<?php

namespace terre\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use terre\Http\Models\BrandModel;
use terre\Http\Models\CategoryModel;
use terre\Http\Models\CustomMenuModel;
use terre\Http\Models\SocialLinkModel;
use terre\Http\Models\StaticPageModel;
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
        $this->_setup_global();

        $this->_start_up(Systems::load_config($this->configType, $this->reset));
        $this->_start_up(Static_Content::load_content($this->reset));

        if(Systems::get($this->configType, 'maintenance_mode')) {
            return view('errors.503');
            exit;
        }
    }

    public function _setup_global() {
        // $this->data['categories']		        = CategoryModel::where('publish', '=', 1)->orderBy('order_id','ASC')->get();
        $this->data['categories']               = DB::table('product_category')
                                                ->join('category', 'product_category.category_id', '=', 'category.id')
                                                ->select('category.id','category.name', 'category.permalink')
                                                ->where('category.publish',1)
                                                ->groupBy('category_id')
                                                ->get();
        $this->data['brands']		            = BrandModel::where('publish', '=', 1)->orderBy('order_id','ASC')->get();
        $this->data['custom_menu']		        = CustomMenuModel::where('publish', '=', 1)->orderBy('order_id','ASC')->get();
        $this->data['social_link']		        = SocialLinkModel::where('publish', '=', 1)->orderBy('order_id','ASC')->get();
        $this->data['support']		            = StaticPageModel::where('publish', '=', 1)->where('fgfooter', '<>', 0)->orderBy('order_id','ASC')->get();
        $this->data['download_catalog']	        = Systems::get($this->configType, 'download');
        $this->data['contact_us']	            = Systems::get($this->configType, 'contact_single_address');
    }

    public function _start_up($config) {
        foreach($config as $key => $conf)
            $this->data[$key] = $conf;
    }

    public function render_view($name) {
        return view($name, $this->data);
    }
}
