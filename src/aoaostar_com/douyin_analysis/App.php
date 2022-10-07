<?php

namespace plugin\aoaostar_com\douyin_analysis;

use plugin\CheckCaptcha;
use plugin\Drive;
use think\facade\Cache;

class App implements Drive, CheckCaptcha
{
    public function Index()
    {
        $startTime = microtime(true);

        $url = request()->param('url');
        preg_match('#http[s]?://(?:[a-zA-Z]|[0-9]|[$-_@.&+]|[!*\(\),]|(?:%[0-9a-fA-F][0-9a-fA-F]))+#', $url, $matches);

        try {
            $url = $matches[0];
            $key = base64_encode($url);
            $analysis = Cache::get(__METHOD__ . '__' . $key);

            if (!empty($analysis)) {
                $analysis['analyze_time'] = microtime(true) - $startTime;
                return success($analysis);
            }

            $url = $this->get_location_url($url);

            preg_match('#/video/(\d+)?#', $url, $matches);

            if (empty($matches[1])) {
                preg_match('#modal_id=(\d+)#', $url, $matches);
            }
            $videoId = $matches[1];
        } catch (\Exception $e) {
            return error('口令或链接有误');
        }

        try {

            $analysis = $this->analysis($videoId);
            $analysis['analyze_time'] = microtime(true) - $startTime;

        } catch (\Exception $e) {
            return error($e->getMessage());
        }
        Cache::set(__METHOD__ . '__' . $key, $analysis, 60);

        return success($analysis);


    }

    private function analysis($videoId)
    {
        $url = "https://www.iesdouyin.com/web/api/v2/aweme/iteminfo/?item_ids=$videoId";
        $aoaostar_get = aoaostar_get($url);
        $json_decode = json_decode($aoaostar_get);

        $albumData = [];
        if (!empty($json_decode->item_list[0])) {
            $item_info = $json_decode->item_list[0];
            $albumData = [
                'analyze_time' => 0,
                'aweme_id' => $item_info->aweme_id,
                'desc' => $item_info->desc,
                'create_time' => format_date($item_info->create_time),
                'share_url' => "https://www.iesdouyin.com/share/video/{$item_info->aweme_id}",
                'author' => [
                    'uid' => $item_info->author->uid,
                    'short_id' => $item_info->author->short_id,
                    'nickname' => $item_info->author->nickname,
                    'signature' => $item_info->author->signature,
                    'unique_id' => $item_info->author->unique_id,
                ],
                'music' => [
                    'id' => $item_info->music->id,
                    'mid' => $item_info->music->mid,
                    'title' => $item_info->music->title,
                    'author' => $item_info->music->author,
                    'play_url' => $item_info->music->play_url->uri,
                ],
                'video' => [
                    'vid' => $item_info->video->vid,
                    'cover' => $item_info->video->cover->url_list[0],
                    'dynamic_cover' => $item_info->video->dynamic_cover->url_list[0],
                    'duration' => $item_info->video->duration,
                    'play_addr' => [
                        'vm' => "https://aweme.snssdk.com/aweme/v1/playwm/?video_id={$item_info->video->vid}&radio=1080p&line=0",
                        'nvm' => "https://aweme.snssdk.com/aweme/v1/play/?video_id={$item_info->video->vid}&ratio=720p&line=0",
                        'nvm_1080p' => "https://aweme.snssdk.com/aweme/v1/play/?video_id={$item_info->video->vid}&radio=1080p&line=0",
                    ],
                ],
            ];
        }
        return $albumData;

    }

    private function get_location_url($url, $headers = [])
    {

        $headers = array_merge([
            'user-agent: Mozilla/5.0 (Linux; Android 8.0; Pixel 2 Build/OPD3.170816.012) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Mobile Safari/537.36 Edg/87.0.664.66'
        ], $headers);
        // 创建一个新 cURL 资源
        $curl = curl_init();
        // 设置URL和相应的选项
        // 需要获取的 URL 地址
        curl_setopt($curl, CURLOPT_URL, $url);
        #启用时会将头文件的信息作为数据流输出。
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_PROXY, \think\facade\Env::get('app.proxy'));
        #在尝试连接时等待的秒数。设置为 0，则无限等待。
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
        #允许 cURL 函数执行的最长秒数。
        curl_setopt($curl, CURLOPT_TIMEOUT, 60);
        #关闭ssl
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        #TRUE 将 curl_exec获取的信息以字符串返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        #设置header
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        // 跟踪重定向
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        // 抓取 URL 并把它传递给浏览器
        $res = curl_exec($curl);
        // 关闭 cURL 资源，并且释放系统资源
        if ($res === false) {
            return "CURL Error:" . curl_error($curl);
        }
        $info = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
        curl_close($curl);
        return $info;
    }
}