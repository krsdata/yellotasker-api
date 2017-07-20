<?php

namespace Modules\Admin\Http\Requests;

use App\Http\Requests\Request;
use Input;

class CategoryGroupRequest  extends Request {

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
                            'group_name' => 'required|unique:category_group,group_name',
                            'group_image' => 'required|mimes:jpeg,png', 
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
