<?php

namespace plugin\aoaostar_com\image_url\nodes\v6;

use plugin\aoaostar_com\image_url\ApiException;
use plugin\aoaostar_com\image_url\Plugin;

class main implements Plugin
{
    public function main($filepath): string
    {

        $data['file'] = new \CURLFile($filepath);
        $data['pid'] = 1001;

        $headers = array(
            CONTENT_TYPE_MULTIPART_FORM_DATA,
            USERAGENT,
        );
        $res = xiaomei_post('https://pic.v.6.cn/api/uploadForGeneral.php', $data
            , $headers);
        $result = json_decode($res);
        if (!empty($result->content->url->link)) {
            return $result->content->url->link;
        }

        if (!empty($result->content)) {
            $msg = $result->content;
        } else {
            $msg = '上传失败';
        }

        throw new ApiException($msg, $res);
    }
}
