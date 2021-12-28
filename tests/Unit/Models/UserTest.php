<?php

namespace Tests\Unit\Models;

use App\Models\Comment;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Role;
use App\Models\User;
use Tests\ModelTestCase;

class UserTest extends ModelTestCase
{
    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            new User(),
            [
                'fillable' => [
                    'name',
                    'email',
                    'phone',
                    'image',
                    'role_id',
                    'address',
                    'password',
                    'is_block',
                ],
                'hidden' => [
                    'password',
                    'remember_token',
                ],
                'casts' => [
                    'id' => 'int',
                    'deleted_at' => 'datetime',
                    'email_verified_at' => 'datetime',
                ]
            ]
        );
    }

    public function testRoleRelations()
    {
        $user = new User();

        $this->assertBelongsToRelation($user->role(), $user, new Role(), 'role_id');
    }

    public function testRatingsRelation()
    {
        $user = new User();

        $this->assertHasManyRelation($user->ratings(), $user, new Rating());
    }

    public function testCommentsRelation()
    {
        $user = new User();

        $this->assertHasManyRelation($user->comments(), $user, new Comment());
    }

    public function testOrdersRelation()
    {
        $user = new User();

        $this->assertHasManyRelation($user->orders(), $user, new Order());
    }
}
