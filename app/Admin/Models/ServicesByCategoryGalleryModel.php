<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/22/2015
 * Time: 4:04 PM
 */
namespace terre\Admin\Models;
use Illuminate\Database\Eloquent\Model;

class ServicesByCategoryGalleryModel extends Model {
    protected $table    = 'services_by_category_gallery';

    public function service() {
        return $this->belongsTo('terre\Admin\Models\ServicesByCategoryModel','fkserviceid', 'id');
    }
    public function gallery() {
        return $this->belongsTo('terre\Admin\Models\GalleriesByCategoryModel','fkgalleryid', 'id');
    }
}