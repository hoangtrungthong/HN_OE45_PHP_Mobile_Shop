<?php

namespace Tests\Unit\Models;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Tests\ModelTestCase;

class CommentTest extends ModelTestCase
{
    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            new Comment(),
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
        $comment = new Comment();

        $this->assertBelongsToRelation(
            $comment->product(),
            $comment,
            new Product(),
            'product_id'
        );
    }

    public function testUserRelations()
    {
        $comment = new Comment();

        $this->assertBelongsToRelation($comment->user(), $comment, new User(), 'user_id');
    }
}
