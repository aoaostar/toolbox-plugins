<?php

namespace plugin\aoaostar_com\code_js;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = 'JavaScript 格式化/混淆/压缩';
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '对JavaScript代码进行格式化/混淆/压缩';
        $model->version = 'v1.0';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
