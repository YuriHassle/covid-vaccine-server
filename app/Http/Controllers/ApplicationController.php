<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Citizen;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Carbon;


class ApplicationController extends BaseController
{

    public function index(Request $request)
    {
        $applications = Application::query();
        
        if($request->filled('cpf')){
            $applications->whereHas('citizen', function($query) use ($request){
                $query->where('cpf', 'like', $request->cpf);
            });
        }

        $applications = $applications->orderBy('application_date')->get();

        return $this->sendResponse($applications, 'Cidadãos recuperados com sucesso.');
    }

    public function store(Request $request)
    {
        $citizen = $request->only(['citizen'])['citizen'];
        $application = $request->except(['citizen']);

        $findCitizen = Citizen::where('cpf', $citizen['cpf'])->doesnthave('applications')->first();
        if($findCitizen){
            $citizen = $findCitizen;
        } else {
            $citizen = Citizen::create($citizen);
        }

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
