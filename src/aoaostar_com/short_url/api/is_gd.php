<?php


namespace plugin\aoaostar_com\short_url\api;


use plugin\aoaostar_com\short_url\api;

class is_gd implements api
{

    public function main($url): string
    {
        $get = aoaostar_get("https://is.gd/create.php?format=json&url=$url");

        $json = json_decode($get);
        if (!empty($json) && !empty($json->shorturl)) {
            return $json->shorturl;
        }
        if (!empty($json->errormessage)) {

            throw new \Exception($json->errormessage);
        }
        throw new \Exception('生成失败');

    }
}