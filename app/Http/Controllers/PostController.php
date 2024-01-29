<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Services\PostService;
use App\Http\Requests\AddpostRequest;
use App\Http\Requests\EditPostRequest;
class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->postService->getUserPosts(Auth::user());

        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddpostRequest $request)
    {
        $result = $this->postService->createPost(Auth::user(), $request);

        if ($result) {
            return to_route('listpost')->with('success', 'Tạo bài viết mới thành công');
        }

        return to_route('listpost')->with('error', 'Không thể tạo bài viết');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = $this->postService->getPostById($id);

        return view('post.article-details', compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = $this->postService->getPostById($id);

        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditPostRequest $request, string $id)
    {
        $post = $this->postService->updatePost($id, $request);

        return to_route('listpost')->with('success', 'Cập nhật bài viết thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    //Xóa post cụ thể
    public function destroy(Request $request)
    {
        $result = $this->postService->deletePost($request->posts_delete_id);

        if ($result) {
            return to_route('listpost')->with('success', 'Xóa bài viết thành công');
        }

        return to_route('listpost')->with('error', 'Không thể xóa bài viết');
    }

    public function destroyAll()
    {
        $this->postService->deleteAllPosts(Auth::user());

        return to_route('listpost')->with('success', 'Xóa tất cả bài viết thành công');
    }

    public function articleDetails()
    {
        $posts = $this->postService->showArticleDetails();

        return view('all-post', compact('posts'));
    }
    public function newsDetails($slug)
    {
        $post = $this->postService->showNewsDetails($slug);

        return view('post.article-details', compact('post'));
    }

}
