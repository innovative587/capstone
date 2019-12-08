<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;

class BaseController extends Controller {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $model_name;
    public $Model;
    
    public function __construct() {
        if (!class_exists($this->model_name)) {
            throw new \Exception('An unexpected error occurred. Please contact customer support. E1002');
        }
        $this->Model = new $this->model_name;
        $this->Query = $this->Model::select("*");
    }
    
    /**
     * Return Error
     */
    public function getError($message, $result=null) {
        return array(
            "status"  => "ng",
            "message" => $message,
            "result"  => $result
        );
    }
    
    public function getModel() {
        return $this->Model;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return array(
            "status"  => "ok",
            "message" => "",
            "result"  => $this->Query->get()
        );
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->input();

        $Model = $this->getModel();
        foreach ($params as $key => $value) {
            $Model->$key = $value;
        }

       
        if (!$Model->save()) {
            return $this->getError("Faild store");
        }
        return array(
            "status"  => "ok",
            "message" => "Stored",
            "result"  => $Model
        );
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Model = $this->getModel();
        $Obj = $Model::find($id);
        if (!$Obj) { return $this->getError("Can not find {$id}"); }
        
        return array(
            "status"  => "ok",
            "message" => "",
            "result"  => $Obj
        );
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        // $params = $request->input("params");
       
        $Model = $this->getModel();
        $Model = $Model::find($id);
        if (!$Model) {
            return $this->getError("Can not find {$id}");
        }
        foreach ($request as $key => $value) {
            $Model->$key = $value;
        }
        if (!$Model->save()) {
            return $this->getError("Faild update {$id}");
        }
        return array(
            "status"  => "ok",
            "message" => "",
            "result"  => $Model
        );
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Model = $this->getModel();
        $Obj = $Model::find($id);
        if (!$Obj) {
            return $this->getError("Can not find {$id}");
        }
        if (!$Obj->delete()) {
            return $this->getError("Faild delete {$id}");
        }
        return array(
            "status"  => "ok",
            "message" => "",
            "result"  => $Obj
        );
    }

}
