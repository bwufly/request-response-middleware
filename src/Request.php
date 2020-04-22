<?php

namespace Wufly\log;

class Request
{
    /**
     * 生成唯一请求id
     * @return String
     */
    public static function generate()
    {
        // 使用session_create_id()方法创建前缀
        $prefix = session_create_id(date('YmdHis'));
        // 使用uniqid()方法创建唯一id
        $request_id = strtoupper(md5(uniqid($prefix, true)));
        // 格式化请求id
        return self::format($request_id);
    }
    /**
     * 格式化请求id
     * @param String $request_id 请求id
     * @param Array $format  格式
     * @return String
     */
    private static function format($request_id, $format = '8,4,4,4,12')
    {
        $tmp = array();
        $offset = 0;
        $cut = explode(',', $format);
        // 根据设定格式化
        if ($cut) {
            foreach ($cut as $v) {
                $tmp[] = substr($request_id, $offset, $v);
                $offset += $v;
            }
        }
        // 加入剩余部分
        if ($offset < strlen($request_id)) {
            $tmp[] = substr($request_id, $offset);
        }
        return implode('-', $tmp);
    }
}
