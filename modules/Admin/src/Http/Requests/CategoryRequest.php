<?php

namespace Modules\Admin\Http\Requests;

use App\Http\Requests\Request;
use Input;

class CategoryRequest  extends Request {

    /**
     * The metric validation rules.
     *
     * @return array    
     */
    public function rules() { 
            switch ( $this->method() ) {
                case 'GET':
                case 'DELETE': {
                        return [ ];
                    }
                case 'POST': {
                        return [
                            'name' => 'required|unique:category_new,name',
                            'description' => 'required',
                            'group_id' => 'required',
                            'image' => 'required|mimes:jpeg,png', 
                        ];
                    }
                case 'PUT':
                case 'PATCH': {
                    if ( $category = $this->categorys) {

                        return [
                            'category_name'   => "required" , 
                        ];
                    }
                }
                default:break;
            }
        //}
    }

    /**
     * The
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

}
