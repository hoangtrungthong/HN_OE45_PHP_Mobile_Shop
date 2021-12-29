<?php

namespace App\Contracts\Repositories;

interface Repository
{
    /**
     * Get all
     * @return mixed
     */
    public function all();

    /**
     * Where
     * @param $id
     * @return mixed
     */
    public function findOrFail($id);

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes = []);

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, $attributes = []);

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * Paginate
     * @param $perPage
     * @param array $column
     * @return mixed
     */
    public function paginate($perPage = 10, $column = ['*']);
}
