<?php namespace terre\Http\Controllers;

use terre\Http\Models\BannerModel;
use terre\Http\Models\BrandModel;
use terre\Http\Models\SlideshowModel;
use terre\Http\Models\TestimonialsModel;
use terre\Http\Models\NewsEventsModel;
use terre\Http\Models\StoresModel;
use terre\Http\Requests;
use Input;
use Cache;
use terre\Http\Models\ConfigModel;
use terre\Libraries\Rates;


class HomePage extends Controller {
    
    protected $rates;

    public function __construct() {
        parent::__construct();
        $this->data['page']		            = "Home";
        $this->data['title']	 			= $this->data['meta_title'];
        $this->data['meta_description'] 	= $this->data['meta_description'];
        $this->data['meta_keywords'] 		= $this->data['meta_keywords'];
        $this->rates = new Rates();
    }

    public function index()
    {
        $this->data['slideshow']               = SlideshowModel::where('publish', '=', 1)->orderBy('order_id','ASC')->first();
        $this->data['banners']                  = BannerModel::where('publish', '=', 1)->orderBy('order_id','ASC')->get();
        $this->data['check_our_video']	        = $this->data['home_check_our_video'];
        $this->data['video_title']	            = $this->data['home_video_title'];
        $this->data['video_description']        = $this->data['home_video_description'];
        $this->data['video']                    = $this->data['home_video'];
        $this->data['testimonials']             = TestimonialsModel::where('publish', '=', 1)->orderBy('order_id','ASC')->take(5)->get();
        $this->data['instagram_feed']           = $this->data['instagram_feed'];
        $this->data['brands']		            = BrandModel::where('publish', '=', 1)->orderBy('order_id','ASC')->get();
        $versions = Input::get('versions', '2');
        $this->data['versions'] = $versions;

        return view('home', $this->data);;
    }

     public function index_ds()
    {
        $this->data['slideshows']               = SlideshowModel::where('publish', '=', 1)->orderBy('order_id','ASC')->get();
        $this->data['stores']                  = StoresModel::where('publish', '=', 1)->orderBy('order_id','ASC')->get();
        $this->data['check_our_video']          = $this->data['home_check_our_video'];
        $this->data['video_title']              = $this->data['home_video_title'];
        $this->data['video_description']        = $this->data['home_video_description'];
        $this->data['video']                    = $this->data['home_video'];
        $this->data['testimonials']             = TestimonialsModel::where('publish', '=', 1)->orderBy('order_id','ASC')->take(5)->get();
        $this->data['instagram_feed']           = $this->data['instagram_feed'];
        $this->data['brands']                   = BrandModel::where('publish', '=', 1)->orderBy('order_id','ASC')->get();
        $this->data['about_title']          = $this->data['about_title'];
        $this->data['about_description']    = $this->data['about_description'];
        $this->data['main_newsandevent']    = NewsEventsModel::where('publish', '=', 1)->orderBy('order_id','DESC')->first();
        return view('newhome', $this->data);;
    }
    
    public function index_dsv2()
    {

        $this->data['slideshow']               = SlideshowModel::where('publish', '=', 1)->orderBy('order_id','ASC')->first();
        $this->data['stores']                  = StoresModel::where('publish', '=', 1)->orderBy('order_id','ASC')->get();
        $this->data['main_stores']                  = StoresModel::where('publish', '=', 1)->where('order_id', '=', 1)->orderBy('order_id','ASC')->first();
        $this->data['stores']                  = StoresModel::where('publish', '=', 1)->orderBy('order_id','ASC')->get();
        $this->data['about_title']          = $this->data['about_title'];
        $this->data['about_description']    = $this->data['about_description'];
        $this->data['newsandevents']    = NewsEventsModel::where('publish', '=', 1)->orderBy('order_id','DESC')->take(3)->get();
        $stores = StoresModel::where('publish', 1)
            ->where('order_id', '<>', 1)
            ->orderBy('order_id', 'ASC')
            ->get();
        
        $branches = $stores->map(function ($store) {
            return [
                'image' => asset('resources/assets/uploads/stores/'.$store->img), // Assuming 'image' is a column in your database
                'title' => $store->name, // Assuming 'title' is a column
                'whatsapp' => "https://wa.me/" . $store->whatsapp_number, // Assuming 'whatsapp' column holds the number
                'direction' => "https://maps.google.com/?q=" . urlencode($store->maps_url), // Assuming 'address' column holds location
                'call1' => "tel:" . $store->call_number_one, // Assuming 'phone1' is a column
                'call2' => "tel:" . $store->call_number_two, // Assuming 'phone2' is a column
            ];
        });
        
        // Pass this to your view
        $this->data['branches'] = json_encode($branches);
        $this->data['stores'] = $stores;
        // $this->data['versions'] = $versions;
        // Cache::forget('exchange_rates');
        $tops = $this->rates->top();
        $this->data['rates'] = $tops['rates'];
        // dd($this->data);
        $this->data['rates_info'] = $tops['information'];
        
        return view('newhomev2', $this->data);;
    }
    
    public function index_slicing()
    {
        $this->data['slideshows']               = SlideshowModel::where('publish', '=', 1)->orderBy('order_id','ASC')->get();
        $this->data['stores']                  = StoresModel::where('publish', '=', 1)->orderBy('order_id','ASC')->get();
        $this->data['check_our_video']          = $this->data['home_check_our_video'];
        $this->data['video_title']              = $this->data['home_video_title'];
        $this->data['video_description']        = $this->data['home_video_description'];
        $this->data['video']                    = $this->data['home_video'];
        $this->data['testimonials']             = TestimonialsModel::where('publish', '=', 1)->orderBy('order_id','ASC')->take(5)->get();
        $this->data['instagram_feed']           = $this->data['instagram_feed'];
        $this->data['brands']                   = BrandModel::where('publish', '=', 1)->orderBy('order_id','ASC')->get();
        $this->data['about_title']          = $this->data['about_title'];
        $this->data['about_description']    = $this->data['about_description'];
        $this->data['main_newsandevent']    = NewsEventsModel::where('publish', '=', 1)->where('order_id', '=', 1)->orderBy('order_id','ASC')->first();
        return view('homeslicing', $this->data);;
    }
    
    public function rates()
    {
        $this->data['slideshow']               = SlideshowModel::where('publish', '=', 1)->orderBy('order_id','ASC')->first();
        Cache::forget('exchange_rates');
        $tops = $this->rates->all();
        $this->data['rates'] = $tops['rates'];
        //dd($this->data['rates']);
        $this->data['rates_info'] = $tops['information'];
        $this->data['subtitle'] = "Exchange Rates";
        return view('rates', $this->data);
    }
    
}
