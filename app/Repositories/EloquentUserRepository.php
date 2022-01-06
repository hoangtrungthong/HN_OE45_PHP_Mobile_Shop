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
}
