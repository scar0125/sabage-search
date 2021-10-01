<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', '100');
            $table->text('body')->nullable();
            $table->string('outdoor');
            $table->string('indoor');
            $table->string('rental');
            $table->string('shuttle');
            $table->string('prefecture');
            $table->string('address');
            $table->string('image_path')->nullable();
            
            $table->integer('per_fee');
            $table->integer('charter_fee');
            
            //作成・更新・削除日時
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
