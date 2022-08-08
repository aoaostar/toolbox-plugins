<?php

namespace plugin\aoaostar_com\image_url;

use plugin\Drive;
use think\facade\Request;
use think\facade\Validate;

class App implements Drive
{

    private $path = "";

    public function __construct()
    {
        $this->path = plugin_path_get(plugin_current_class_get(__NAMESPACE__));
        require "$this->path/Plugin.php";
        require "$this->path/common.php";
        require "$this->path/ApiException.php";
    }

    public function upload()
    {
        $validate = Validate::rule([
            'node' => 'require|alphaDash',
            'file' => 'require|file|fileExt:jpg,jpeg,png,gif,bmp.webp,ico',
        ]);

        $node = Request::param('node');
        $uploadedFile = Request::file('file');

        if (!$validate->check([
            'node' => $node,
            'file' => $uploadedFile,
        ])) {
            return msg('error', $validate->getError());
        }

        if (!file_exists("$this->path/nodes/$node/main.php")) {
            return msg('error', "该节点[$node]不存在");
        }
        require "$this->path/nodes/$node/main.php";

        if (!class_exists($node)) {
            return msg('error', "该节点[$node]不存在");
        }
        $filename = uniqid() . '.' . $uploadedFile->extension();
        $tmpDir = app()->getRuntimePath() . '/tmp';
        if (!is_dir($tmpDir)) {
            mkdir($tmpDir, 0644, true);
        }
        try {

            $uploadedFile->move($tmpDir, $filename);
            $instance = new $node();
            $res = $instance->main($tmpDir . DIRECTORY_SEPARATOR . $filename);

            return msg('ok', "success", [
                'url' => $res,
            ]);

        } catch (\Exception $e) {
            return msg('error', $e->getMessage());
        } finally {
            @unlink($tmpDir . DIRECTORY_SEPARATOR . $filename);
        }
    }

    public function Index()
    {
        // TODO: Implement Index() method.
    }
}