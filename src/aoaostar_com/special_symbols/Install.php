<?php

namespace plugin\aoaostar_com\special_symbols;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = "常用特殊符号大全";
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '本页汇总了一些可打印的特殊符号，可用于微博聊天等情景使用。';
        $model->version = 'v1.0';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
