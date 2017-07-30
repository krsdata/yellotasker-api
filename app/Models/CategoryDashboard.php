<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent; 

class CategoryDashboard extends Eloquent {

     protected $parent = 'parent_id';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categoryDashboard';
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
    protected $fillable = ['name','category','display_order','category_id'];   

}