<?php

namespace Tests\Unit\Models;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Tests\ModelTestCase;

class CommentTest extends ModelTestCase
{
    protected $comment;

    public function setUp(): void
    {
        parent::setUp();
        $this->comment = new Comment();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->comment);
    }

    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            $this->comment,
            [
                'fillable' => [
                    'product_id',
                    'user_id',
                    'content',
                ],
            ]
        );
    }


    public function testProductRelations()
    {
        $this->assertBelongsToRelation(
            $this->comment->product(),
            $this->comment,
            new Product(),
            'product_id'
        );
    }

    public function testUserRelations()
    {
        $this->assertBelongsToRelation($this->comment->user(), $this->comment, new User(), 'user_id');
    }
}
