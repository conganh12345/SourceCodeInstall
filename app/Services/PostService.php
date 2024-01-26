<?php
// app/services/PostService.php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public function getUserPosts($user, $perPage = 4)
    {
        $posts = $user->posts()->paginate($perPage);

        return $this->transformPosts($posts);
    }
    protected function transformPosts($posts)
    {
        // Bạn có thể thêm bất kỳ xử lý chuyển đổi dữ liệu nào bạn cần ở đây
        // Chẳng hạn, định dạng ngày, làm việc với hình ảnh, v.v.
        return $posts;
    }
    public function createPost($user, $requestData)
    {
        $post = new Post([
            'title' => $requestData->input('title'),
            'description' => $requestData->input('description'),
            'content' => $requestData->input('content'),
            'publish_date' => $requestData->input('publish_date') ?? null,
            'status' => '0',
        ]);

        $user->posts()->save($post);

        if ($requestData->hasFile('thumbnail')) {
            $thumbnailFile = $requestData->file('thumbnail');

            // Thêm ảnh vào disk 'public' mà không thuộc collection nào cả
            $post->addMedia($thumbnailFile)->toMediaCollection();

            // Không cần lưu tên tệp tin vào trường 'thumbnail' của bài viết nữa
        }

        return $post;
    }

    public function deletePost($postId)
    {
        $post = Post::find($postId);
        if ($post) {
            $post->delete();
            return true;
        }
        return false;
    }

    public function deleteAllPosts($user)
    {
        $user->posts()->delete();
    }
}
