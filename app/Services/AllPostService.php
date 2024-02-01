<?php


namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmailJob;

class AllPostService
{
    public function getAllPosts($perPage = 4)
    {
        $posts = Post::paginate($perPage);

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
            'status' => $requestData->input('status', '0'),
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

    public function deleteAllPosts()
    {
        Post::query()->delete();
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

    $previousStatus = $post->status;

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


    if ($previousStatus != $post->status) {
        $this->sendPostStatusEmail($post);
    }

    return $post;
}

private function sendPostStatusEmail($post)
{
    $data = [
        'email' => $post->user->email,
        'status' => $post->status,
        'title' => $post->title,

    ];

    // Thực hiện công việc gửi email thông báo
    dispatch(new SendEmailJob($data));
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

    public function searchPosts($searchType, $searchValue)
    {
        $query = Post::query();

        if ($searchType === 'email') {
            $query->whereHas('user', function ($userQuery) use ($searchValue) {
                $userQuery->where('email', 'like', '%' . $searchValue . '%');
            });
        }

        if ($searchType === 'title') {
            $query->where('title', 'like', '%' . $searchValue . '%');
        }

        return $query->get();
    }

}
