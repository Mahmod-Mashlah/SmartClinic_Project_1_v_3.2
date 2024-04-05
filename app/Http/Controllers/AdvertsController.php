<?php

namespace App\Http\Controllers;

use App\Models\Adverts;
use App\Http\Requests\StoreAdvertsRequest;
use App\Http\Requests\UpdateAdvertsRequest;

class AdvertsController extends Controller
{
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
     * @param  \App\Http\Requests\StoreAdvertsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdvertsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adverts  $adverts
     * @return \Illuminate\Http\Response
     */
    public function show(Adverts $adverts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adverts  $adverts
     * @return \Illuminate\Http\Response
     */
    public function edit(Adverts $adverts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdvertsRequest  $request
     * @param  \App\Models\Adverts  $adverts
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdvertsRequest $request, Adverts $adverts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adverts  $adverts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adverts $adverts)
    {
        //
    }
}
