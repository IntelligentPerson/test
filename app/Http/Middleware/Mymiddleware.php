<?php

namespace App\Http\Middleware;

use Closure;
use App\Client;
use Illuminate\Support\Facades\View;

class Mymiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $session_id = session()->getId();
        $session = Client::where('session_id', $session_id)->first();

        if (!$session){
            $ip_address = $request->ip();
            $user_agent = $request->header('User-Agent');

            $client = new Client;
            $client->ip = $ip_address;
            $client->browser = $user_agent;
            $client->session_id = $session_id;

            $client->save();
        }

        $clients = Client::orderBy('browser')->get();

        $result = [];
        $client_browser = '';
        $client_browser_count = 1;

        $total = count($clients);
        $counter = 0;

        foreach ($clients as $client){

            if ($counter == 0){
                $client_browser = $client->browser;
                $client_browser_count = 0;
            }
            $counter++;

            if ($client->browser == $client_browser){
                $client_browser_count += 1;
            } else {
                $result[] = $client_browser.' : '.$client_browser_count;

                $client_browser_count = 1;
                $client_browser = $client->browser;
            }

            if ($counter == $total){
                $result[] = $client_browser.' : '.$client_browser_count;
            }
        }

        View::share('clients_in_header', $result);

        return $next($request);
    }
}
