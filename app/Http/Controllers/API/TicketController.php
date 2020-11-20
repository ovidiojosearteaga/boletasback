<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Validator;
use App\Http\Resources\Ticket as TicketResource;

class TicketController extends BaseController
{
    public function index() 
    {
        $tickets = Ticket::all();

        return $this->sendResponse(TicketResource::collection($tickets), 'tickets retrieved successfully.');
    }

    public function store(Request $request)
    {
        $ticketData = $request->all();

        $validator = Validator::make($ticketData, [
            'user_id' => 'required'
        ]);

        if ($validator->fails())
            return $this->sendError('Validation Error.', $validator->errors());

        $ticket = Ticket::create($ticketData);

        return $this->sendResponse(new TicketResource($ticket), 'ticket created successfully.');
    }

    public function show($id) 
    {
        $ticket = Ticket::find($id);

        if (is_null($ticket))
            $this->sendError('ticket not found.');

        return $this->sendResponse(new TicketResource($ticket), 'ticket retrieved successfully.');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return $this->sendResponse([], 'ticket delete successfully');
    }
}
