<?php


namespace plugin\aoaostar_com\short_url\api;


use plugin\aoaostar_com\short_url\api;

class moelink_org implements api
{

    public function main($url): string
    {
        $get = aoaostar_post('https://moelink.org/shorten', [
            'url' => $url,
        ]);
        $json = json_decode($get);
        if (!empty($json) && !empty($json->data->shorturl) && $json->error === false) {
            return $json->data->shorturl;
        }
        if (!empty($json->message)) {

            throw new \Exception($json->message);
        }
        throw new \Exception('生成失败');

    }
}