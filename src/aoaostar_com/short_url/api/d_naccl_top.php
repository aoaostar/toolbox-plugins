<?php


namespace plugin\aoaostar_com\short_url\api;


use plugin\aoaostar_com\short_url\api;

class d_naccl_top implements api
{

    public function main($url): string
    {
        $get = aoaostar_post('https://d.naccl.top/generate', [
            'longURL' => $url,
        ]);
        $json = json_decode($get);
        if (!empty($json) && !empty($json->data) && $json->code === 200) {
            return $json->data;
        }
        if (!empty($json->msg)) {

            throw new \Exception($json->msg);
        }
        throw new \Exception('生成失败');

    }
}