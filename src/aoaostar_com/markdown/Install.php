<?php

namespace plugin\aoaostar_com\markdown;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = "Markdown在线编辑器";
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '一个在线编辑markdown的工具';
        $model->version = 'v1.0';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
