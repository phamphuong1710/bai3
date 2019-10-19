<?php
namespace App\Service;

use App\InterfaceService\UserInterface;
use Intervention\Image\ImageManagerStatic as Image;
use App\User; // model
use App\Media;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use DB;
use File;

class UserService implements UserInterface
{
    protected $userModel;
    protected $mediaModel;
    protected $db;

    public function __construct(User $userModel, Media $mediaModel, DB $db)
    {
        $this->userModel = $userModel;
        $this->mediaModel = $mediaModel;
        $this->db = $db;
    }

    public function getAllUser()
    {
        $users = $this->userModel->orderBy('created_at','desc')->paginate(15);

        return $users;
    }

    public function getUserById($id)
    {
        $user = $this->userModel->findOrFail($id);
        if(!$user) abort('404');

        return $user;
    }

    public function deleteUserById($id)
    {
        $this->userModel->where('id', $id)->delete();

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
        $user = $this->userModel->findOrFail($id);
        if(!$user) abort('404');
        $user->name = $request->name;
        $user->phone = $request->phone;
        if ( $request->logo_id ) {
            $mediaId = (int)$request->logo_id;
            $media = $this->mediaModel->findOrFail($mediaId);
            $user->avatar = $media->image_path;
        }
        $this->db->table('model_has_roles')->where('model_id',$id)->delete();
        $user->save();

        return $user;
    }

    public function searchUser($request)
    {
        $user = $this->userModel->where('name', 'like', '%' . $request->user . '%')
            ->get();

        return $user;
    }

    public function filterUser($request)
    {
        $user = $this->userModel->orderBy($request->order, $request->orderby)
            ->get();

        return $user;
    }
}

