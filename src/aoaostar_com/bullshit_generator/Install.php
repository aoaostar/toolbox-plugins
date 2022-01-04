<?php

namespace plugin\aoaostar_com\bullshit_generator;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = '文章生成器';
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '生成一篇狗屁不通的文章';
        $model->version = 'v1.0';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
