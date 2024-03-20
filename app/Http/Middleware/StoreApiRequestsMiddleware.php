<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class StoreApiRequestsMiddleware
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
        $duration = round($this->end - $this->start,2);
        $url = $request->fullUrl();
        $reqBody = json_encode(Arr::except($request->all(), ['transaction_pin','password','otp']));
        $resBody = $response->getContent();
        $method = $request->getMethod();
        $ip = $request->getClientIp();
        $status = $response->getStatusCode();
        $userAgent = $request->header('user-agent');

        $log = "{$ip}: [{$status}] {$method}@{$url} - {$duration}ms" . " [Request : " . $reqBody . "] [Response : " . $resBody . "][User-agent : " . $userAgent;

        Log::channel('http_logs')->info($log);
    }


}
