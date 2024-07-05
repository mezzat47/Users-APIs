<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    /**
     * @return Collection
     */
    public function getAllUsers(): \Illuminate\Database\Eloquent\Collection
    {
        return User::all();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function createUser(array $data): mixed
    {
        if (isset($data['photo'])) {
            $data['photo'] = $this->storePhoto($data['photo']);
        }
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUserById($id): mixed
    {
        return User::find($id);
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function updateUser($id, array $data): mixed
    {
        $user = User::find($id);

        if ($user) {
            $user->update($data);
        }

        return $user;
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteUser($id): bool
    {
        $user = User::find($id);

        if ($user) {
            if ($user->photo) {
                Storage::delete($user->photo);
            }
            $user->delete();
            return true;
        }

        return false;
    }

    private function storePhoto($photo)
    {
        return $photo->store('photos', 'public');
    }
}
