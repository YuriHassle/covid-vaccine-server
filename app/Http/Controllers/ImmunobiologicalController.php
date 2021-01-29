<?php

namespace App\Http\Controllers;

use App\Models\Immunobiological;
use Illuminate\Http\Request;

class ImmunobiologicalController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imbs = Immunobiological::orderBy('name')->get();
        return $this->sendResponse($imbs, 'Imunobiologicos recuperados com sucesso.');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Immunobiological  $immunobiological
     * @return \Illuminate\Http\Response
     */
    public function show(Immunobiological $immunobiological)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Immunobiological  $immunobiological
     * @return \Illuminate\Http\Response
     */
    public function edit(Immunobiological $immunobiological)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Immunobiological  $immunobiological
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Immunobiological $immunobiological)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Immunobiological  $immunobiological
     * @return \Illuminate\Http\Response
     */
    public function destroy(Immunobiological $immunobiological)
    {
        //
    }
}
