<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent; 

use Nestable\NestableTrait;

class Category extends Eloquent {

   // use NestableTrait;

    // protected $parent = 'parent_id';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'category_new';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     /**
     * The primary key used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','image'];  // All field of user table here    


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function categorygroup()
    {
       
        return $this->belongsTo('Modules\Admin\Models\CategoryGroup','id');
    }

    /*public function parent()
    {
        return $this->belongsTo('Modules\Admin\Models\Category', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('Modules\Admin\Models\Category', 'parent_id','id');
    }*/
  
    
  
}
