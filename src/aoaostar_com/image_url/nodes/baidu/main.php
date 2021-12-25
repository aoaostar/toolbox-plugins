<?php


class baidu implements plugin
{

    public function main($filepath): string
    {

        $data = [
            'no_compress' => '1',
            'id' => 'WU_FILE_0',
            'is_avatar' => '0'
        ];
        $data['media'] = new \CURLFile($filepath);

        $headers = array(
            CONTENT_TYPE_MULTIPART_FORM_DATA,
            USERAGENT,
        );
        $res = xiaomei_post('https://baijiahao.baidu.com/builderinner/api/content/file/upload', $data
            , $headers);
        $result = json_decode($res);
        if (!empty($result->ret->https_url)) {
            $explode = explode('@', $result->ret->https_url);
            return $explode[0];
        }
        if (!empty($result->errmsg)) {
            $msg = $result->errmsg;
        } else {
            $msg = '上传失败';
        }

        throw new ApiException($msg, $res);
    }
}
