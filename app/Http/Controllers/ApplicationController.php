<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Citizen;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Carbon;


class ApplicationController extends BaseController
{

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $citizen = $request->only(['citizen']);
        $application = $request->except(['citizen']);

        $citizen = Citizen::create($citizen['citizen']);
        $application['citizen_id'] = $citizen->id;
        $application['record_date'] = Carbon\Carbon::now();
        $application = Application::create($application);

        return $this->sendResponse($application, 'Dados salvos com sucesso.', 201); 
    }

    public function show(Application $application)
    {
        //
    }

    public function update(Request $request, Application $application)
    {
        //
    }

    public function destroy(Application $application)
    {
        //
    }
}
