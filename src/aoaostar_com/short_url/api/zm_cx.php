<?php


namespace plugin\aoaostar_com\short_url\api;


use plugin\aoaostar_com\short_url\api;

class zm_cx implements api
{

    public function main($url): string
    {
        $get = aoaostar_post('https://zm.cx/api/set.php', json_encode([
            'url' => $url,
        ]));
        $json = json_decode($get);
        if (!empty($json) && !empty($json->content->url)) {
            return $json->content->url;
        }
        if (!empty($json->content)) {

            throw new \Exception($json->content);
        }
        throw new \Exception('生成失败');

    }
}