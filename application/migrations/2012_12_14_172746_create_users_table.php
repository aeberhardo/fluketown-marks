<?php

class Create_Users_Table {

    public function up() {

        Schema::create('users', function($table) {

                    $table->engine = 'InnoDB';

                    $table->increments('id');
                    $table->string('username', 32)->unique();
                    $table->string('email', 200);
                    $table->string('password', 200); // Hashed password.
                    $table->timestamps();
                });
    }

    public function down() {

        Schema::drop('users');
    }

}