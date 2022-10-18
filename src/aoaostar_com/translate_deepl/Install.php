<?php

namespace plugin\aoaostar_com\translate_deepl;


use app\model\Plugin;

class Install implements \plugin\Install
{
    # 安装时运行方法
    public function Install(Plugin $model)
    {
        # 标题
        $model->title = "DeepL翻译";
        # 类名、无需修改
        $model->class = plugin_current_class_get(__NAMESPACE__);
        # 路由、即 example
        $model->alias = base_space_name(__NAMESPACE__);
        # 描述
        $model->desc = '全世界最准确的翻译';
        $model->template = 'redirect';
        $model->config = [
            'url'=>'https://www.deepl.com/translator'
        ];
        # 版本号
        $model->version = 'v1.0';
    }

    # 卸载时运行方法
    public function UnInstall(Plugin $model)
    {

    }
}