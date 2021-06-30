<?php

namespace Wufly\Log;

use Closure;
use Wufly\Log\Jobs\SaveLogJob;
use Wufly\Log\Request;
use Illuminate\Support\Facades\Config;
use Wufly\Logstash;

class RequestAndResponseLog
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Config::get('requestLog.enabled')) {
            return $next($request);
        }
        $requestId = $request->server->get(Config::get('requestLog.request_id_name'));
        if (!$requestId) {
            $requestId = (new Request())->generate();
        }
        // 请求url
        $url = $request->fullUrl();
        // 请求方法
        $method = $request->method();
        // 获取请求的header头
        $request_headers = $request->header();
        // 获取请求的body
        $request_data = $request->all();

        // 添加requestId
        $response = $next($request);

        // 获取响应的状态
        $status = $response->getStatusCode();
        // 获取响应的header头
        $response_headers = $response->headers->all();
        // 获取响应的数据
        $response_data = $response->getContent();

        $data = [
            'request_id' => $requestId,
            'request_url' => $url,
            'method' => $method,
            'request_headers' => json_encode($request_headers),
            'request_data' => json_encode($request_data),
            'response_status' => $status,
            'response_headers' => json_encode($response_headers),
            'response_data' => json_encode($response_data),
            'created_at' => now()->toDateTimeString(),
        ];
        Logstash::channel('request-and-response-log')->info('', $data);

        if (Config::get('requestLog.table.save')) {
            SaveLogJob::dispatch($data);
        }
        return $response;
    }
}
