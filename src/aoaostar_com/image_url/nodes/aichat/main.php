<?php

class aichat implements plugin
{

    public function main($filepath): string
    {

        $data = [
            'single' =>  new \CURLFile($filepath),
        ];

        $headers = array(
            CONTENT_TYPE_MULTIPART_FORM_DATA,
            USERAGENT,
        );
        $res = xiaomei_post('https://upload.aichat.net/upload/single', $data, $headers);
        $result = json_decode($res);
        if (!empty($result->url)) {
            return $result->url;
        }

        if (!empty($result->error)) {
            $msg = $result->error;
        } else {
            $msg = '上传失败';
        }
        throw new ApiException($msg,$res);
    }
}
