<?php

namespace App\Http\Controllers;
use App\Services\AllPostService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddpostRequest;
use App\Http\Requests\EditPostRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Post;

class AllPostController extends Controller
{
    protected $postService;

    public function __construct(AllPostService $postService)
    {
        $this->postService = $postService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->postService->getAllPosts();
        return view('admin.all-post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.all-post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddpostRequest $request)
    {

        $result = $this->postService->createPost(Auth::user(), $request);

        if ($result) {
            return to_route('admin.manageAllPosts')->with('success', 'Tạo bài viết mới thành công');
        }

        return to_route('admin.manageAllPosts')->with('error', 'Không thể tạo bài viết');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // $post = $this->postService->getPostById($id);

        return view('admin.all-post.article-details', compact('post'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // $post = $this->postService->getPostById($id);
        return view('admin.all-post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditPostRequest $request, Post $post)
    {
        $post = $this->postService->updatePost($post, $request);

        return to_route('admin.manageAllPosts')->with('success', 'Cập nhật bài viết thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $result = $this->postService->deletePost($request->posts_delete_id);

        if ($result) {
            return to_route('admin.manageAllPosts')->with('success', 'Xóa bài viết thành công');
        }

        return to_route('admin.manageAllPosts')->with('error', 'Không thể xóa bài viết');
    }

    public function destroyAll()
    {
        $this->postService->deleteAllPosts();

        return to_route('admin.manageAllPosts')->with('success', 'Xóa tất cả bài viết thành công');
    }

    public function search(Request $request)
{
    $searchType = $request->input('search_type');
    $searchValue = $request->input('search');

    // Gọi phương thức tìm kiếm từ PostService
    $posts = $this->postService->searchPosts($searchType, $searchValue);

    // Trả về kết quả tìm kiếm vào view hoặc làm gì đó khác với kết quả
    return view('admin.all-post.index', compact('posts', 'searchType', 'searchValue'));
}


}
