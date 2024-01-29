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

    public function getPostById(string $id)
{

    $post = Post::find($id);

    return $post;
}

public function updatePost(string $id, $requestData)
{
    $post = Post::find($id);

    if (!$post) {
        abort(404);
    }

    $post->title = $requestData->input('title');
    $post->slug = $requestData->input('slug');
    $post->description = $requestData->input('description');
    $post->content = $requestData->input('content');
    $post->publish_date = $requestData->input('publish_date');
    $post->status = $requestData->input('status');

    if ($requestData->hasFile('thumbnail')) {
        $thumbnailFile = $requestData->file('thumbnail');
        $post->addMedia($thumbnailFile)->toMediaCollection();
    }

    $post->save();

    return $post;
}

public function showArticleDetails()
    {

    $statusActive = '1'; // Thay thế 'active' bằng giá trị ENUM thật của bạn
    $posts = Post::where('status', $statusActive)->get();

    return $this->transformPosts($posts);

    }
    public function showNewsDetails($slug)
    {

        $statusActive = '1'; // Replace '1' with the actual ENUM value
        $post = Post::where('slug', $slug)
                     ->where('status', $statusActive)
                     ->first();

        return $this->transformPosts($post);

    }
}
