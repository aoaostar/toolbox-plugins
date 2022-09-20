<?php

namespace plugin\aoaostar_com\random_anime_images;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = '随机动漫图';
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '随机返回一张动漫图';
        $model->version = 'v1.2';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
