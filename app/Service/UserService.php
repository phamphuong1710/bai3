<?php
namespace App\Service;

use App\InterfaceService\UserInterface;
use Intervention\Image\ImageManagerStatic as Image;
use App\User; // model
use App\Media;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use File;


class UserService implements UserInterface
{
    public function getAllUser()
    {
        $users = User::orderBy('created_at','desc')->paginate(15);

        return $users;
    }

    public function getUserById($id)
    {
        $user = User::findOrFail($id);
        if(!$user) abort('404');

        return $user;
    }

    public function deleteUserById($id)
    {
        User::where('id', $id)->delete();

        return true;
    }

    public function createUser($request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();

        return $user;
    }

    public function updateUser($request, $id)
    {
        $user = User::findOrFail($id);
        if(!$user) abort('404');
        $user->name = $request->name;
        $user->phone = $request->phone;
        $mediaId = (int)$request->logo_id;
        $media = Media::findOrFail($mediaId);
        $user->avatar = $media->image_path;
        $user->save();

        return $user;
    }

    public function searchUser($request)
    {
        $user = User::where('name', 'like', '%'.$request->user.'%')
            ->get();

        return $user;
    }

    public function filterUser($request)
    {
        $user = User::orderBy($request->order, $request->orderby)
            ->get();

        return $user;
    }
}

