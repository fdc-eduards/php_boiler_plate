<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Model.php');

ORM::configure([
    'connection_string' => 'mysql:host=mysql;dbname=boilerplate',
    'username' => 'root',
    'password' => 'root'
]);

class Main_Controller
{
    public function __construct()
    {
    }

    public function insert_db(String $table, Array $params) {
        $model = new Model($table);

        return $model->insert_db($params);
    }


    public function json($data, $isDebug = false) {
        if($isDebug) {
            echo '<pre>';
            print_r($isDebug);
            return;
        }

        echo json_encode($data);
    }
}
