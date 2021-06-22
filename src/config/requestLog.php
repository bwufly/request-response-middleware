<?php

/**
 * Created by vscode.
 * User: wufly
 * Date: 2020/4/22 下午2:31
 */

return [
    'enabled'       => env('REQUESTLOG_ENABLED', true),
    'table' => [
        'save' => env('REQUESTLOG_TABLE_SAVE', false),
        'name' => env('REQUESTLOG_TABLE_NAME', 'request_logs')
    ],
    'request_id_name' => env('REQUEST_ID_NAME', 'request-id'),
];
