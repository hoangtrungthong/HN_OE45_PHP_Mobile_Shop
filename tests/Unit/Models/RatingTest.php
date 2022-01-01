<?php

namespace Tests\Unit\Models;

use App\Models\Product;
use App\Models\Rating;
use App\Models\User;
use Tests\ModelTestCase;

class RatingTest extends ModelTestCase
{
    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            new Rating(),
            [
                'fillable' => [
                    'product_id',
                    'user_id',
                    'vote',
                ],
            ]
        );
    }

    public function testProductRelation()
    {
        $rating = new Rating();

        $this->assertBelongsToRelation($rating->product(), $rating, new Product(), 'product_id');
    }

    public function testUserRelation()
    {
        $rating = new Rating();

        $this->assertBelongsToRelation($rating->user(), $rating, new User(), 'user_id');
    }
}
