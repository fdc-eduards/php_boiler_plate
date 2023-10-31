<?php
require_once('Main_Controller.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Model.php');

class UserController extends Main_Controller
{
    public $for_table;
    public function __construct()
    {
        $this->for_table = 'users';
    }
    public function users($name)
    {
        echo "Username: {$name}";
        $users = ORM::for_table('users')->find_array();
        echo '<pre>';
        print_r($users);
    }

    public function test()
    {
        echo json_encode($_POST);
    }
    public function test2()
    {
        $model = new Model($this->for_table);

        $params = [
            'name' => 'eduardo',
            'username' => 'tydus016',
            'password' => '123'
        ];

        if ($model->insert_db($_POST)) {
            $res['message'] = 'insert successfully';
            $res['status'] = true;
        } else {
            $res['message'] = 'error';
            $res['status'] = false;
        }

        $this->json($res);
    }
}
