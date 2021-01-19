<?php

namespace App\Http\Controllers;

use App\Models\Servicegroup;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class ServicegroupController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicegroups = Servicegroup::all();
        return $this->sendResponse($servicegroups, 'Grupos de atendimento recuperados com sucesso.');
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
     * @param  \App\Models\Servicegroup  $servicegroup
     * @return \Illuminate\Http\Response
     */
    public function show(Servicegroup $servicegroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Servicegroup  $servicegroup
     * @return \Illuminate\Http\Response
     */
    public function edit(Servicegroup $servicegroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Servicegroup  $servicegroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servicegroup $servicegroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Servicegroup  $servicegroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servicegroup $servicegroup)
    {
        //
    }
}
