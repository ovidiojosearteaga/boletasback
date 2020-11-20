<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Configuration;
use Validator;
use App\Http\Resources\Configuration as ConfigurationResource;

class ConfigurationController extends BaseController
{
    public function index() 
    {
        $configations = Configuration::all();

        return $this->sendResponse(ConfigurationResource::collection($configations), 'configurations retrieved successfully.');
    }

    public function store(Request $request)
    {
        $configurationData = $request->all();

        $validator = Validator::make($configurationData, [
            'max_tickets' => 'required'
        ]);

        if ($validator->fails())
            return $this->sendError('Validation Error.', $validator->errors());

        $configuration = Configuration::create($configurationData);

        return $this->sendResponse(new ConfigurationResource($configuration), 'configuration created successfully.');
    }

    public function update(Request $request, Configuration $configuration)
    {
        $configuration->max_tickets = isset($request->max_tickets) ? $request->max_tickets : $user->max_tickets;

        $configuration->save();

        return $this->sendResponse(new ConfigurationResource($configuration), 'configuration updated successfully.');
    }

    public function show($id) 
    {
        $configuration = Configuration::find($id);

        if (is_null($configuration))
            $this->sendError('configuration not found.');

        return $this->sendResponse(new ConfigurationResource($configuration), 'configuration retrieved successfully.');
    }
}
