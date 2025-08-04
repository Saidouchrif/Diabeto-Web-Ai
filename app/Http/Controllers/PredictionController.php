<?php

namespace App\Http\Controllers;

use App\Models\prediction;
use App\Http\Requests\StorepredictionRequest;
use App\Http\Requests\UpdatepredictionRequest;

class PredictionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepredictionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(prediction $prediction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(prediction $prediction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepredictionRequest $request, prediction $prediction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(prediction $prediction)
    {
        //
    }
}
