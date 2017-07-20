<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent; 

//use Nestable\NestableTrait;

class CategoryGroup extends Eloquent {

   // use NestableTrait;

    // protected $parent = 'parent_id';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'category_group';
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
    protected $fillable = ['id','group_name','group_description','group_image'];  // All field of user table here    


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    /* public function subcategory()
    {
       
        return $this->belongsTo('Modules\Admin\Models\Category','id','parent_id');
    }

    public function parent()
    {
        return $this->belongsTo('Modules\Admin\Models\Category', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('Modules\Admin\Models\Category', 'parent_id','id');
    }*/
  
    
  
}
