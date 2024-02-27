<?php
// app/services/PostService.php

namespace App\Services;

use App\Models\Post;
use App\Enums\UserStatus;

class PostService
{
    public function getUserPosts($user, $perPage = 4)
    {
        $posts = $user->posts()->paginate($perPage);

        return $this->transformPosts($posts);
    }
    protected function transformPosts($posts)
    {
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

public function updatePost($post, $requestData)
{

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
        // Kiểm tra xem ảnh cũ có tồn tại không và xóa nó
        if ($post->getMedia()->count() > 0) {
            $post->getMedia()[0]->delete();
        }

        // Thêm ảnh mới vào media collection với tên 'thumbnail'
        $thumbnailFile = $requestData->file('thumbnail');
        $post->addMedia($thumbnailFile)->toMediaCollection();
    }

    $post->save();

    return $post;
}

public function showArticleDetails()
    {

    $statusActive = UserStatus::ACTIVE;
    $posts = Post::where('status', $statusActive)->get();

    return $this->transformPosts($posts);

    }
    public function showNewsDetails($slug)
    {

        $statusActive = UserStatus::ACTIVE;
        $post = Post::where('slug', $slug)
                     ->where('status', $statusActive)
                     ->first();

        return $this->transformPosts($post);

    }
}
