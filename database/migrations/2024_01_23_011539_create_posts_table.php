<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('content');
            $table->string('thumbnail')->nullable();
            $table->dateTime('publish_date');
            $table->enum('status', ['0', '1', '2'])->default('0');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
        });

        DB::table('posts')->insert([
            'user_id' => 1, // ID của user (thay thế bằng ID thực tế)
            'title' => 'Tiêu đề bài viết',
            'slug' => 'tieu-de-bai-viet',
            'description' => 'Mô tả ngắn gọn về bài viết',
            'content' => 'Nội dung chi tiết của bài viết',
            'thumbnail' => 'hotnew.jpg', // Đường dẫn đến ảnh thumbnail
            'publish_date' => now(), // Sử dụng Carbon để lấy ngày và giờ hiện tại
            'status' => '0', // Trạng thái bài viết
            'created_at' => now(), // Cập nhật thời gian tạo
            'updated_at' => now(), // Cập nhật thời gian cập nhật
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
