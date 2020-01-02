<?php

namespace RMoore\Resourceful;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ResourceController extends Controller
{
    protected function modelClass()
    {
        $matches = [];
        if (preg_match("/(\w+)Controller$/", get_class($this), $matches)) {
            return sprintf('App\\%s', $matches[1]);
        }
    }

    protected function model(Request $request)
    {
        $class = $this->modelClass();

        if (! $class) {
            return;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $model = $this->model($request);

        return $model;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
