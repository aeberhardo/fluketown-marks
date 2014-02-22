<?php

class Create_Tags_Table {

    public function up() {

        Schema::create('tags', function($table) {

                    $table->engine = 'InnoDB';

                    $table->increments('id');
                    $table->integer('bookmark_id')->unsigned();
                    $table->string('name', 200);
                    $table->timestamps();

                    $table->unique(array('bookmark_id', 'name'));
                    $table->index('name');
                    $table->foreign('bookmark_id')->references('id')->on('bookmarks')->on_delete('cascade');
                });
    }

    public function down() {

        Schema::drop('tags');
    }

}