<?php

namespace App\Repositories;

use App\Contracts\Repositories\RoleRepository;
use App\Models\Role;

class ELoquentRoleRepository extends EloquentRepository implements RoleRepository
{
    public function __construct(Role $model)
    {
        return parent::__construct($model);
    }
}
