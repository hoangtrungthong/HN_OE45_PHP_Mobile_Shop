<?php

namespace Tests;

use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

abstract class ModelTestCase extends TestCase
{
    protected function runConfigurationAssertions(Model $model, $assertions)
    {
        $assertions = array_merge(
            [
            'fillable' => [],
            'hidden' => [],
            'guarded' => ['*'],
            'visible' => [],
            'casts' => ['id' => 'int', 'deleted_at' => 'datetime'],
            'dates' => ['created_at', 'updated_at'],
            'collectionClass' => Collection::class,
            'table' => null,
            'primaryKey' => 'id',
            'connection' => null,
            ],
            $assertions
        );
        extract($assertions);
        $this->assertEquals($assertions['fillable'], $model->getFillable());
        $this->assertEquals($assertions['guarded'], $model->getGuarded());
        $this->assertEquals($assertions['hidden'], $model->getHidden());
        $this->assertEquals($assertions['visible'], $model->getVisible());
        $this->assertEquals($assertions['casts'], $model->getCasts());
        $this->assertEquals($assertions['dates'], $model->getDates());
        $this->assertEquals($assertions['primaryKey'], $model->getKeyName());
        $c = $model->newCollection();
        $this->assertEquals($assertions['collectionClass'], get_class($c));
        $this->assertInstanceOf(Collection::class, $c);
        if ($assertions['connection'] !== null) {
            $this->assertEquals($assertions['connection'], $model->getConnectionName());
        }
        if ($assertions['table'] !== null) {
            $this->assertEquals($assertions['table'], $model->getTable());
        }
    }

    protected function assertHasManyRelation(
        $relation,
        Model $model,
        Model $related,
        $key = null,
        $parent = null,
        Closure $queryCheck = null
    ) {
        $this->assertInstanceOf(HasMany::class, $relation);
        if (!is_null($queryCheck)) {
            $queryCheck->bindTo($this);
            $queryCheck($relation->getQuery(), $model, $relation);
        }
        if (is_null($key)) {
            $key = $model->getForeignKey();
        }
        $this->assertEquals($key, $relation->getForeignKeyName());
        if (is_null($parent)) {
            $parent = $model->getKeyName();
        }
        $this->assertEquals($model->getTable().'.'.$parent, $relation->getQualifiedParentKeyName());
    }

    protected function assertBelongsToRelation(
        $relation,
        Model $model,
        Model $related,
        $key,
        $owner = null,
        Closure $queryCheck = null
    ) {
        $this->assertInstanceOf(BelongsTo::class, $relation);
        if (!is_null($queryCheck)) {
            $queryCheck->bindTo($this);
            $queryCheck($relation->getQuery(), $model, $relation);
        }
        $this->assertEquals($key, $relation->getForeignKeyName());
        if (is_null($owner)) {
            $owner = $related->getKeyName();
        }
        $this->assertEquals($owner, $relation->getOwnerKeyName());
    }
}
