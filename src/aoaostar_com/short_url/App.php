<?php

namespace plugin\aoaostar_com\short_url;

use plugin\Drive;
use think\facade\Validate;

class App implements Drive
{


    public function Index()
    {
        return msg("ok", "success", plugin_info_get());
    }

    public function generate()
    {
//        https://is.gd/create.php?format=json&url=https://zhuanlan.zhihu.com/p/43348582&logstats=1
        $params = request()->param();
        $validate = Validate::rule([
            'type' => 'require',
            'url' => 'require|url'
        ]);
        if (!$validate->check($params)) {
            return msg('error', $validate->getError());
        }
        $class = "\\plugin\\aoaostar_com\\short_url\\api\\{$params['type']}";
        if (!class_exists($class)) {

            return msg('error', '该接口不存在');
        }
        $instance = new $class();
        try {

            $shortUrl = $instance->main($params['url']);

        } catch (\Exception $e) {

            return msg('error', $e->getMessage());
        }
        return msg('ok', 'success', [
            'short_url' => $shortUrl
        ]);

    }
}