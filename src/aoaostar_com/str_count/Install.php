<?php

namespace plugin\aoaostar_com\str_count;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = '字符串长度计算';
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '提供文本长度计算功能，可以计算文本包含的全角、半角、英文、数字、中文及一些特殊字符的长度';
        $model->version = 'v1.0';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
