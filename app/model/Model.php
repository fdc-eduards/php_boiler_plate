<?php

ORM::configure([
    'connection_string' => 'mysql:host=mysql;dbname=boilerplate',
    'username' => 'root',
    'password' => 'root'
]);

class Model
{

    public $_table;

    public function __construct($table_name)
    {
        $this->_table = $table_name;
    }

    public function initORM()
    {
        return ORM::for_table($this->_table);
    }

    public function insert_db(array $params)
    {
        $table = ORM::for_table($this->_table)->create();

        foreach ($params as $column => $value) {
            $table->$column = $value;
        }

        return $table->save();
    }
}
