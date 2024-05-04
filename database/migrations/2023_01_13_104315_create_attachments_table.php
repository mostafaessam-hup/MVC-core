<?php

use App\Base\Enums\AttachmentType;
use App\Models\Attachment;
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
        Schema::create(Attachment::getTableName(), function (Blueprint $table) {
            $table->increments('id');
            $table->string('original');
            $table->string('extension');
            $table->string('photo_400')->nullable();
            $table->string('photo_600')->nullable();
            $table->string('photo_800')->nullable();
            $table->enum('type', AttachmentType::casesValues())->default(AttachmentType::IMAGE->value);
            $table->string('usage')->nullable();
            $table->string('display_name')->nullable();
            $table->string('attachmentable_type');
            $table->integer('attachmentable_id');
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
        Schema::dropIfExists(Attachment::getTableName());
    }
};
