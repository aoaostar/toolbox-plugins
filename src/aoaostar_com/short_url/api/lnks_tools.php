<?php


namespace plugin\aoaostar_com\short_url\api;


use plugin\aoaostar_com\short_url\api;

class lnks_tools implements api
{

    public function main($url): string
    {
        $get = aoaostar_post('https://lnks.tools', json_encode([
            'url' => $url,
        ]));
        $json = json_decode($get);
        if (!empty($json) && !empty($json->key)) {
            return 'https://lnks.tools' . $json->key;
        }
        throw new \Exception('生成失败');

    }
}