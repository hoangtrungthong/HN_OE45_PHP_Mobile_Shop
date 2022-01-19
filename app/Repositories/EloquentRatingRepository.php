<?php

namespace app\Repositories;

use App\Contracts\Repositories\RatingRepository;
use App\Models\Rating;

class ELoquentRatingRepository extends EloquentRepository implements RatingRepository
{
    public function __construct(Rating $model)
    {
        return parent::__construct($model);
    }
}
