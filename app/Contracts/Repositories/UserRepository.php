<?php

namespace App\Contracts\Repositories;

interface UserRepository extends Repository
{
    public function findAdmin();

    public function getCurrentNotifications($id);
    
    public function getNotifications();
}
