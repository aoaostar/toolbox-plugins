<?php

namespace plugin\aoaostar_com\json;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = 'JSON解析及格式化';
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '在线格式化解析JSON,在线格式化JSON,在线美化JSON';
        $model->version = 'v1.1';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
