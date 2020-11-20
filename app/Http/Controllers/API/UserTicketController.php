<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ticket;
use App\Http\Resources\Ticket as TicketResource;
use App\Http\Resources\User as UserResource;
use App\Models\Configuration;

class UserTicketController extends BaseController
{
    public function get(User $user) 
    {
        $tickets = $user->tickets;
        return $this->sendResponse(TicketResource::collection($tickets), 'tickets from user retrieved successfully.');
    }

    public function getUser(Ticket $ticket)
    {
        $user = $ticket->user;
        return $this->sendResponse(new UserResource($user), 'user retrieved successfully.');
    }

    public function getAvailableTickets() 
    {
        $max_tickets = null;

        if (isset(Configuration::all()[0]))
            $max_tickets = Configuration::all()[0]->max_tickets;

        if ($max_tickets !== null) {
            $current_tickets = count(Ticket::all());
            
            $message = ['tickets_available' => $max_tickets - $current_tickets] ;

            return $this->sendResponse($message, 'max tickets retrieved successfully');

        } else {
            return $this->sendResponse(null, 'has not configuration');
        }
    }
}
