<?php

namespace App\Repositories;

use App\Contracts\Repositories\CommentRepository;
use App\Models\Comment;

class ELoquentCommentRepository extends EloquentRepository implements CommentRepository
{
    public function __construct(Comment $model)
    {
        return parent::__construct($model);
    }
}
