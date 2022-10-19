<?php

namespace plugin\aoaostar_com\image_url;

use Exception;
use plugin\Drive;
use think\facade\Request;
use think\facade\Validate;

class App implements Drive
{

    private $path = "";

    public function __construct()
    {
        $this->path = plugin_path_get(plugin_current_class_get(__NAMESPACE__));
        require_once "$this->path/common.php";
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
            return error($validate->getError());
        }

        if (!file_exists("$this->path/nodes/$node/main.php")) {
            return error("该节点[$node]不存在");
        }
        $class = '\\' . __NAMESPACE__ . "\\nodes\\$node\\main";

        if (!class_exists($class)) {
            return error("该节点[$node]不存在");
        }
        $filename = uniqid() . '.' . $uploadedFile->extension();
        $tmpDir = app()->getRuntimePath() . '/tmp';
        if (!is_dir($tmpDir)) {
            mkdir($tmpDir, 0755, true);
        }
        try {

            $uploadedFile->move($tmpDir, $filename);
            $instance = new $class();

            $res = $instance->main($tmpDir . DIRECTORY_SEPARATOR . $filename);

            return msg('ok', "success", [
                'url' => $res,
            ]);

        } catch (Exception $e) {
            return error($e->getMessage());
        } finally {
            @unlink($tmpDir . DIRECTORY_SEPARATOR . $filename);
        }
    }

    public function Index()
    {
        // TODO: Implement Index() method.
    }
}