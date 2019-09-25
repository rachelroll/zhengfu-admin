<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name')->default('')->comment('电影名称');
            $table->string('cover')->default('')->comment('电影封面图');
            $table->string('path')->default('')->comment('资源路径');
            $table->string('remark')->default('')->comment('备注');
            $table->string('description')->default('')->comment('剧情描述');
            $table->string('director')->default('')->comment('导演');
            $table->string('editor')->default('')->comment('编剧');
            $table->string('actors')->default('')->comment('主演');
            $table->string('region')->default('')->comment('地区');
            $table->string('date')->default('')->comment('上映日期');
            $table->string('language')->default('')->comment('语言');
            $table->string('category_id')->default('')->comment('分类ID');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
