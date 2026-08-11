<?php namespace terre\Http\Controllers;

use Illuminate\Support\Facades\Response;
use terre\Http\Requests;

class Action extends Controller {

    public function __construct() {
        parent::__construct();
        $this->data['page']		            = "Catalog";
        $this->data['title']	 			= $this->data['meta_title'];
        $this->data['meta_description'] 	= $this->data['meta_description'];
        $this->data['meta_keywords'] 		= $this->data['meta_keywords'];
    }

    public function catalog()
    {
        return Response::download('resources/assets/uploads/download/'.$this->data['download'], $this->data['download']);
    }
}
