<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/23/2015
 * Time: 2:52 PM
 */
namespace terre\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model {
    protected $table    = 'project';

    public function images(){
        return $this->hasMany('terre\Admin\Models\ProjectImageModel', 'project_id')
            ->orderBy('as_default', 'desc')
            ->orderBy('id', 'asc');
    }

    public function image($project_id){
        $img = $this->images->find($project_id);

        return $img->orderBy('as_default', 'desc')
            ->orderBy('id', 'asc')
            ->first();
    }
}