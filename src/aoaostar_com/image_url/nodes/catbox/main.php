<?php

namespace plugin\aoaostar_com\image_url\nodes\catbox;

use plugin\aoaostar_com\image_url\ApiException;
use plugin\aoaostar_com\image_url\Plugin;

class main implements Plugin
{

    public function main($filepath): string
    {

        $data = [
            'reqtype' => 'fileupload',
            'fileToUpload' => new \CURLFile($filepath),
        ];

        $headers = array(
            CONTENT_TYPE_MULTIPART_FORM_DATA,
            USERAGENT,
        );
        $res = xiaomei_post('https://catbox.moe/user/api.php', $data, $headers);
        if (is_valid_url($res)) {
            return $res;
        }

        $message = '上传失败';
        throw new ApiException($message,$res);
    }
}
