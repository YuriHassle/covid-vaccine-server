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

        $applications = $applications->orderBy('application_date')->with('citizen')->get();

        return $this->sendResponse($applications, 'Aplicações de vacina recuperadas com sucesso.');
    }

    public function store(Request $request)
    {
        $citizen = $request->only(['citizen'])['citizen'];
        $application = $request->except(['citizen', 'updated_by']);

        $findCitizen = Citizen::where('cpf', $citizen['cpf'])->doesnthave('applications')->first();
        if($findCitizen){
            $citizen = $findCitizen;
        } else {
            $citizen = Citizen::create($citizen);
        }

        $application['citizen_id'] = $citizen->id;
        $application = Application::create($application);

        return $this->sendResponse($application, 'Aplicação de vacina salva com sucesso.', 201);
    }

    public function show(Application $application)
    {
        //
    }

    public function update(Request $request, Application $application)
    {
        $newCitizen = $request->only(['citizen'])['citizen'];
        $newApplication = $request->except(['citizen', 'user_id']);
        $citizen = Citizen::find($application->citizen_id);
        if($citizen->cpf != $newCitizen['cpf']){
            return $this->sendError('Não é possível alterar o CPF');
        }
        //TODO: use validate to require updated_ by field
        $citizen->update($newCitizen);
        $application->update($newApplication);
        return $this->sendResponse($application, 'Aplicação de vacina alterada com sucesso.');
    }

    public function destroy(Application $application)
    {
        //
    }
}
