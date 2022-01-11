<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepository;
use App\Models\User;

class ELoquentUserRepository extends EloquentRepository implements UserRepository
{
    public function __construct(User $model)
    {
        return parent::__construct($model);
    }

    public function findAdmin()
    {
        return $this->model
            ->where('role_id', config('const.admin'))
            ->firstOrFail();
    }

    public function getCurrentNotifications($id)
    {
        return $this->findAdmin()
            ->notifications
            ->where('id', $id)
            ->firstOrFail();
    }

    public function getNotifications()
    {
        return $this->findAdmin()->notifications;
    }
}
