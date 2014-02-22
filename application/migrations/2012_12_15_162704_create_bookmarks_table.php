<?php

class Create_Bookmarks_Table {

    public function up() {

        Schema::create('bookmarks', function($table) {

                    $table->engine = 'InnoDB';

                    $table->increments('id');
                    $table->integer('user_id')->unsigned();
                    $table->string('url', 500);
                    $table->string('title', 200);
                    $table->string('description', 1000)->nullable();
                    $table->boolean('favorite')->default(0);
                    $table->timestamps();
                    
                    $table->foreign('user_id')->references('id')->on('users')->on_delete('cascade');
                });
    }

    public function down() {

        Schema::drop('bookmarks');
    }

}