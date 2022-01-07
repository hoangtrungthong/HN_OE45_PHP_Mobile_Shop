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
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = new User();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->user);
    }

    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            $this->user,
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
        $this->assertBelongsToRelation($this->user->role(), $this->user, new Role(), 'role_id');
    }

    public function testRatingsRelation()
    {
        $this->assertHasManyRelation($this->user->ratings(), $this->user, new Rating());
    }

    public function testCommentsRelation()
    {
        $this->assertHasManyRelation($this->user->comments(), $this->user, new Comment());
    }

    public function testOrdersRelation()
    {
        $this->assertHasManyRelation($this->user->orders(), $this->user, new Order());
    }
}
