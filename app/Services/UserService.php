<?php


namespace App\Services;

use App\Models\User;

class UserService
{

    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserById(string $id)
{

    $user = User::find($id);

    return $user;
}

public function updateUser(string $id, $requestData)
{
            $user = User::find($id);

            if (!$user) {
                abort(404);
            }



            $user->first_name = $requestData->input('first_name');
            $user->last_name = $requestData->input('last_name');
            $user->address = $requestData->input('address');
            $user->status = $requestData->input('status');

            $user->save();


            return $user;

    }

    public function searchUser($searchType, $searchValue)
    {
        $query = User::query();

        if ($searchType === 'email') {
            $query->where('email', 'like', '%' . $searchValue . '%');
        }

        if ($searchType === 'name') {
            $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $searchValue . '%']);
        }

        return $query->get();
    }

}
