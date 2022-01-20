<?php


namespace plugin\aoaostar_com\short_url\api;


use plugin\aoaostar_com\short_url\api;

class suo_yt implements api
{

    public function main($url): string
    {
        $get = aoaostar_post('https://suo.yt/short', [
            'longUrl' => base64_encode($url),
        ]);
        $json = json_decode($get);
        if (!empty($json) && !empty($json->ShortUrl)) {
            return $json->ShortUrl;
        }
        if (!empty($json->Message)) {

            throw new \Exception($json->Message);
        }
        throw new \Exception('生成失败');

    }
}