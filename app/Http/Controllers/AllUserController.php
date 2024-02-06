<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\User;


class AllUserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Gọi hàm từ UserService để lấy tất cả users
        $users = $this->userService->getAllUsers();

        return view('admin.all-user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function edit(User $user)
    {

        return view('admin.all-user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user = $this->userService->updateUser($user, $request);

        return to_route('admin.manageAllUsers')->with('success', 'Cập nhật tài khoản thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request)
{
    $searchType = $request->input('search_type');
    $searchValue = $request->input('search');

    // Gọi phương thức tìm kiếm từ PostService
    $users = $this->userService->searchUser($searchType, $searchValue);

    // Trả về kết quả tìm kiếm vào view hoặc làm gì đó khác với kết quả
    return view('admin.all-user.index', compact('users', 'searchType', 'searchValue'));
}
}
