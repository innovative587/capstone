<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use Auth;

class ApiController extends BaseController
{
    public $model_name = 'App\Event';
    
    public function index(){
        $this->Query->orderBy('created_at', 'DESC')->where('user_id', Auth::id())->get();

        return Parent::index();
    }

    public function store(Request $request){
        // dd($request->input()); exit;
        $request->request->add(['user_id' => Auth::user()->id]);
        
        return Parent::store($request);
    }
}
