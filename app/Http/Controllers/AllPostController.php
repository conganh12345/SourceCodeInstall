<?php

namespace App\Http\Controllers;
use App\Services\AllPostService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddpostRequest;
use App\Http\Requests\EditPostRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Post;
use DataTables;

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
        return view('admin.all-post.show', compact('post'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
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

        $posts = $this->postService->searchPosts($searchType, $searchValue);

        return view('admin.all-post.index', compact('posts', 'searchType', 'searchValue'));
    }


    public function getPosts()
    {
        $post = Post::select('thumbnail','title','description','publish_date','status');
        return Datatables::of($post)
                ->addColumn('action', function ($post) {
                    $btnShow = '<button onclick="window.location=' . "'" . route('admin.createAllPost') . "'" . ';" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></button>';
                    $btnEdit = '<a href="' . '" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>';
                    $btnDelete = '<button class="btn btn-danger btn-sm deletePost" data-toggle="modal" data-target="#deleteModal" data-post-id="' . $post->id . '"><i class="fas fa-trash"></i></button>';

                    return $btnShow . ' ' . $btnEdit . ' ' . $btnDelete;
                })
                ->make(true);
    }



}
