<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Model.php');

class Main_Controller
{
    public $document_root;

    public function __construct()
    {
        $this->document_root = $_SERVER['DOCUMENT_ROOT'];
    }

    public function load_assets($classname, $asset_type)
    {
        $assets = [
            "user" => [
                "css" => ["user"],
                "js" => ["user"],
            ]
        ];

        $module_assets = $assets[$classname];
        $base_url = BASE_URL;
        if ($asset_type === "css") {
            foreach ($module_assets["css"] as $key => $value) {
                $src = "{$base_url}assets/modules/{$classname}/css/{$value}.css";

                echo "<link rel='stylesheet' href='$src'>";
            }
        } else if ($asset_type === "js") {
            foreach ($module_assets["js"] as $key => $value) {
                $src = "{$base_url}assets/modules/{$classname}/js/{$value}.js";

                echo "<script src='$src'></script>";
            }
        }
    }

    public function load_view($classname, $pagename, $dataincludes = [])
    {
        $data = [
            "modulename" => $classname
        ];
        $data = array_merge($data, $dataincludes);

        extract($data);
        include_once($this->document_root . "app/views/includes/header.php");
        include_once($this->document_root . "app/views/" . $classname . "/" . $pagename . ".php");
        include_once($this->document_root . "app/views/includes/footer.php");
    }

    public function json($data, $isDebug = false)
    {
        if ($isDebug) {
            echo '<pre>';
            print_r($isDebug);
            return;
        }

        echo json_encode($data);
    }
}
