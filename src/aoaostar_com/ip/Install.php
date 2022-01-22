<?php

namespace plugin\aoaostar_com\ip;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = 'IP查询';
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '全方位查询你的IP信息';
        $model->version = 'v1.0';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
