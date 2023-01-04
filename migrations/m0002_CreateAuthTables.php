<?php

/*
 * Copyright (c) 2023.
 * User: 
 * project: Wizarphics
 * Date Created: 01/02/23, 08:44 AM
 * Last Modified at: 01/02/23, 08:44 AM
 * Time: 08:44:48
 *
 */

use wizarphics\wizarframework\Schema;

class M0002_CreateAuthTables extends Schema
{
    public function up()
    {
        // Create PwdReset Table
        $this->addField([
            'id'                => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'pwd_reset_secret'  => ['type' => 'varchar', 'null' => false, 'constraint' => 255],
            'pwd_reset_selector' => ['type' => 'varchar', 'null' => false, 'constraint' => 255],
            'pwd_reset_token'    => ['type' => 'varchar', 'null' => false,  'constraint' => 255],
            'pwd_reset_expires'  => ['type' => 'datetime', 'null' => false],
        ]);
        $this->addPrimaryKey('id');
        $this->createTable('pwd_reset', true);

        // Create Remember Table
        $this->addField([
            'id'                => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'           => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'selector'          => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'hash'              => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'expires'           => ['type' => 'datetime', 'null' => false],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->addPrimaryKey('id');
        $this->addForeignKey('user_id', 'users', 'id', '', 'CASCADE');
        $this->createTable('auth_rm_session', true);

        // Create Permissions Table
        $this->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'permission' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at' => ['type' => 'datetime', 'null' => false],
        ]);
        $this->addPrimaryKey('id');
        $this->addForeignKey('user_id', 'users', 'id', '', 'CASCADE');
        $this->createTable('auth_user_permissions', true);

        // Create Roles table
        $this->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'role' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at' => ['type' => 'datetime', 'null' => false],
        ]);
        $this->addPrimaryKey('id');
        $this->addForeignKey('user_id', 'users', 'id', '', 'CASCADE');
        $this->createTable('auth_user_roles', true);
    }

    public function down()
    {
        //Drop PwdReset Table
        // $this->dropTable('pwd_reset', true);
        //Drop Remember Table
        // $this->dropTable('auth_rm_session', true);
        //Drop Permissions Table
        // $this->dropTable('auth_user_permissions', true);
        //Drop Roles Table
        // $this->dropTable('auth_user_roles', true);
    }
}
