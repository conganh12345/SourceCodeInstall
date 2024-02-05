<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Thêm dòng này
use Illuminate\Support\Facades\Schema; // Thêm dòng này
use App\Models\User; // Thêm dòng này
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('posts')->insert([
        //     'user_id' => 1, // ID của user (thay thế bằng ID thực tế)
        //     'title' => 'Tiêu đề bài viết',
        //     'slug' => 'tieu-de-bai-viet',
        //     'description' => 'Mô tả ngắn gọn về bài viết',
        //     'content' => 'Nội dung chi tiết của bài viết',
        //     'thumbnail' => 'hotnew.jpg', // Đường dẫn đến ảnh thumbnail
        //     'publish_date' => now(), // Sử dụng Carbon để lấy ngày và giờ hiện tại
        //     'status' => '0', // Trạng thái bài viết
        //     'created_at' => now(), // Cập nhật thời gian tạo
        //     'updated_at' => now(), // Cập nhật thời gian cập nhật
        // ]);

    // Seed Posts
        \App\Models\Post::factory(5)->create();
    }
}
