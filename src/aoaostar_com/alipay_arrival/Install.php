<?php

namespace plugin\aoaostar_com\alipay_arrival;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = '支付宝到账语音';
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '在线生成支付宝到账音效，输入金额，即刻到账！';
        $model->version = 'v1.2';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
