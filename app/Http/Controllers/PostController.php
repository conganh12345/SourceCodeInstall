<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy người dùng hiện tại
        $user = Auth::user();

        // Lấy tất cả bài viết của người dùng hiện tại sử dụng mối quan hệ đã định nghĩa
        $posts = $user->posts()->paginate(1);

        return view('Post.listpost', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Post.Addpost');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    //Xóa post cụ thể
    public function destroy(Request $request)
    {
        $post = Post::find($request->posts_delete_id);
        $post->delete();

        return redirect()->route('listpost')->with('success','Xóa bài viết thành công');
    }

    //Xóa tất cả post
    public function destroyAll()
    {
        // Lấy người dùng hiện tại
        $user = Auth::user();

        // Xóa tất cả bài viết của người dùng hiện tại sử dụng mối quan hệ
        $user->posts()->delete();

        return redirect()->route('listpost')->with('success', 'Xóa tất cả bài viết thành công');
    }
    public function showedit()
    {
        return view('Post.Editpost');
    }
    public function showpost()
    {
        return view('Post.Showpost');
    }
}
