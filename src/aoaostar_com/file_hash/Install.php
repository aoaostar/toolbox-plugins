<?php

namespace plugin\aoaostar_com\file_hash;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = '文件哈希计算';
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '计算文件的各种哈希值';
        $model->version = 'v1.1';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
