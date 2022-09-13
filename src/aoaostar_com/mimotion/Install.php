<?php

namespace plugin\aoaostar_com\mimotion;


use app\model\Plugin;

class Install implements \plugin\Install
{
    # 安装时运行方法
    public function Install(Plugin $model)
    {
        $model->title = "小米步数";
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '通过小米运动API实现的自动刷运动步数工具，可同步到微信、支付宝';
        $model->version = 'v1.0';
    }

    # 卸载时运行方法
    public function UnInstall(Plugin $model)
    {

    }
}