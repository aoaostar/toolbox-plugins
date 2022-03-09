<?php

namespace plugin\aoaostar_com\seo;


use app\model\Plugin;

class Install implements \plugin\Install
{
    # 安装时运行方法
    public function Install(Plugin $model)
    {
        # 标题
        $model->title = "SEO综合查询";
        # 类名、无需修改
        $model->class = plugin_current_class_get(__NAMESPACE__);
        # 路由、即 example
        $model->alias = base_space_name(__NAMESPACE__);
        # 描述
        $model->desc = 'seo综合查询可以查到该网站在各大搜索引擎的信息，包括收录，反链及关键词排名，也可以一目了然的看到该域名的相关信息，比如域名年龄相关备案等等，及时调整网站优化。';
        $model->template = 'redirect';
        $model->config = [
            'url' => 'https://seo.chinaz.com/'
        ];
        # 版本号
        $model->version = 'v1.0';
    }

    # 卸载时运行方法
    public function UnInstall(Plugin $model)
    {

    }
}