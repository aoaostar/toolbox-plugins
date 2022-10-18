<?php

namespace plugin\aoaostar_com\translate_youdao;


use app\model\Plugin;

class Install implements \plugin\Install
{
    # 安装时运行方法
    public function Install(Plugin $model)
    {
        # 标题
        $model->title = "有道翻译";
        # 类名、无需修改
        $model->class = plugin_current_class_get(__NAMESPACE__);
        # 路由、即 example
        $model->alias = base_space_name(__NAMESPACE__);
        # 描述
        $model->desc = '网易有道翻译';
        $model->template = 'redirect';
        $model->config = [
            'url'=>'https://fanyi.youdao.com/'
        ];
        # 版本号
        $model->version = 'v1.0';
    }

    # 卸载时运行方法
    public function UnInstall(Plugin $model)
    {

    }
}