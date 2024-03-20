<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\UserEvent;
use App\Services\UserEventService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StoreApiEventMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    private $start, $end;

    public function handle(Request $request, Closure $next)
    {
        $this->start = microtime(true);
        return $next($request);
    }

    /**
     * Handle tasks after the response has been sent to the browser.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Http\Response $response
     * @return void
     */
    public function terminate($request, $response)
    {
        $this->end = microtime(true);
//        dd($request);
        $this->log($request, $response);
    }

    protected function log($request, $response)
    {
        $duration = round($this->end - $this->start, 2);
        $url = $request->fullUrl();
        $reqArr = $request->all();
        $reqBody = Arr::except($reqArr, ['transaction_pin', 'password', 'otp']);
        $resBody = json_decode($response->getContent());

        $method = $request->getMethod();
        $ip = $request->getClientIp();
        $status = $response->getStatusCode();

        $user = ($request->route('user')) ? $request->route('user') : $request->user();

        if (!isset($user)) {
            Log::error('Terminate middleware user not found ' . $method . ' - ' . $url . ' | Body :  ' . json_encode($reqArr) . ' | Res : ' . json_encode($resBody));
            return;
        }

        $event = (new UserEventService($user))->getApiEvent($request, $request->method());

        if ($event)
            (new UserEventService($user))->createEvent([
                'is_system_logged_event' => true,
                'remark' => 'Api logged event',
                'event' => $event,
                'action_user_id' => $request->user()->id,
                'data' => [
                    'url' => $url,
                    'method' => $method,
                    'duration' => $duration,
                    'logged_user_id' => $request->user()->id,
                    'action_on_user_id' => $user->id,
                    'request' => $reqBody,
                    'response' => $resBody,
                    'response_status' => $status,
                    'ip' => $ip,
                    'user_agent' => $request->header('user-agent'),
                ]
            ]);


    }
}
