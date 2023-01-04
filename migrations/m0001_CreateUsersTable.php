<?php

use wizarphics\wizarframework\Schema;

class m0001_CreateUsersTable extends Schema
{
    protected $tableName = 'users';
    public function up()
    {
        $this->addField([
            'id'             => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'firstname'      => ['type' => 'varchar', 'constraint' => 255],
            'lastname'       => ['type' => 'varchar', 'constraint' => 255],
            'email'          => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'password'       => ['type' => 'text', 'null' => false],
            'status'         => ['type' => 'integer', 'null' => false],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at'     => ['type' => 'datetime', 'null' => true, 'default' => null]

        ]);
        $this->addPrimaryKey('id');
        $this->createTable($this->tableName, true);
    }

    public function down()
    {

        // $this->dropTable($this->tableName);
    }
}
