<?php

namespace Tests\Unit\Models;

use App\Models\Role;
use App\Models\User;
use Tests\ModelTestCase;

class RoleTest extends ModelTestCase
{
    protected $role;

    public function setUp(): void
    {
        parent::setUp();
        $this->role = new Role();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->role);
    }

    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            $this->role,
            [
                'fillable' => [
                    'name',
                ],
            ]
        );
    }

    public function testUsersRelation()
    {
        $this->assertHasManyRelation($this->role->users(), $this->role, new User(), 'role_id');
    }
}
