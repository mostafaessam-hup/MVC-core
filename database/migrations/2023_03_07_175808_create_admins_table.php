<?php

use App\Models\Admin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Admin::getTableName(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->boolean('status')->default(true);
            $table->rememberToken();
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
        Schema::dropIfExists(Admin::getTableName());
    }
};
