<?php


namespace plugin\aoaostar_com\short_url\api;


use plugin\aoaostar_com\short_url\api;

class tinyurl_com implements api
{

    public function main($url): string
    {
        $get = aoaostar_post('https://tinyurl.com/api-create.php', [
            'url' => $url,
            'format' => 'json',
        ]);
        if (is_valid_url($get)) {
            return $get;
        }
        throw new \Exception('生成失败');

    }
}