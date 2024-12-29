<?php

namespace App\Repositories;

interface RepositoryInterface
{

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id): mixed;

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes = []): mixed;

    /**
     * Insert
     * @param array $attributes
     * @return mixed
     */
    public function insert(array $attributes);

    /**
     * Insert get id
     * @param array $attributes
     * @return mixed
     */
    public function insertGetId(array $attributes);

    /**
     * InsertOrUpdate
     * @param array $attributes
     * @return mixed
     */
    public function insertOrUpdate($conditions = [], array $attributes = []): mixed;

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes = []): mixed;

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id): mixed;
}
