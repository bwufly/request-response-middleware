<?php

/**
 * Created by vscode.
 * User: wufly
 * Date: 2020/4/22 下午2:31
 */

return [
    'enabled'       => env('REQUESTLOG_ENABLED', true),
    'table' => env('REQUESTLOG_TABLE', 'request_logs'),
];
