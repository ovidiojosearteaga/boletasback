<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\Ticket;
use App\Models\Configuration;

class CheckTicketsNumber
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $tickets = Ticket::all();

        if (isset(Configuration::all()[0])) {
            $max_tickets = Configuration::all()[0]->max_tickets;
        } else {
            $max_tickets = null;
        }

        if ($max_tickets !== null && count($tickets) >= $max_tickets) {
            $response = [
                'sucess' => false,
                'message' => 'No has tickets.',
            ];
    
            return response()->json($response, 404);
        
        } else {
            return $next($request);
        }
    }
}
