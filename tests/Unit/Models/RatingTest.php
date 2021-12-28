<?php

namespace Tests\Unit\Models;

use App\Models\Product;
use App\Models\Rating;
use App\Models\User;
use Tests\ModelTestCase;

class RatingTest extends ModelTestCase
{
    protected $rating;

    public function setUp(): void
    {
        parent::setUp();
        $this->rating = new Rating();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->rating);
    }

    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            $this->rating,
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
        $this->assertBelongsToRelation($this->rating->product(), $this->rating, new Product(), 'product_id');
    }

    public function testUserRelation()
    {
        $this->assertBelongsToRelation($this->rating->user(), $this->rating, new User(), 'user_id');
    }
}
