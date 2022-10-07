<?php

namespace plugin\aoaostar_com\ip;

use plugin\Drive;
use think\facade\Validate;

class App implements Drive
{


    public function Index()
    {
        return success(plugin_info_get());
    }

    public function query()
    {
        $ip = request()->param('ip');
        $validate = Validate::rule([
            'ip' => 'ip'
        ]);
        if (!$validate->check(['ip' => $ip])) {
            return error($validate->getError());
        }
        if (empty($ip)) {
            $ip = client_ip();
        }
        //https://api.iplocation.net/?ip=
        $get = aoaostar_get('http://whois.pconline.com.cn/ipJson.jsp?json=true&ip=' . $ip);
        $json = json_decode(iconv('gbk', 'utf-8', $get));
        if (empty($get)) {
            return error('查询失败，请重试');
        }
        return success([
            'ip' => $json->ip,
            'location' => $json->addr,
        ]);
    }
}

if (!function_exists('client_ip')) {

    function client_ip()
    {
        $ip = request()->server('HTTP_CF_CONNECTING_IP');
        return $ip ?: request()->ip();
    }
}