<?php

namespace App\InterfaceService;

interface UserInterface {
    public function getAllUser();
    public function getUserById($id);
    public function updateUser($request, $id);
    public function createUser($request);
    public function searchUser($request);
    public function filterUser($request);
}
