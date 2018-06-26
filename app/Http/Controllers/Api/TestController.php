<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function index(){
        $result = [];
        $result['data']=[]; 
        $result['data']['emails']=
            [
                ['id'=>1, 'title'=>'first', 'email'=>'asd@asd.com', 'created_at'=>'12/12/1950', 'updated_at'=>'12/12/1950'],
                ['id'=>2, 'title'=>'second', 'email'=>'asd@asd.com', 'created_at'=>'12/12/1950', 'updated_at'=>'12/12/1950'],
            ];
        return $result;
    }

}
