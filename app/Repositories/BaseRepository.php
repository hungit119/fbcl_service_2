<?php

namespace App\Repositories;

abstract class BaseRepository implements RepositoryInterface
{
    protected $_model;
    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();
    public function setModel()
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    public function find($id): mixed
    {
        // TODO: Implement find() method.
        $result = $this->_model->find($id);

        return $result;
    }
    public function create(array $attributes = []): mixed
    {
        // TODO: Implement create() method.
        return $this->_model->create($attributes);
    }
    public function insert(array $attributes)
    {
        return $this->_model->insert($attributes);
    }

    public function insertGetId(array $attributes)
    {
        return $this->_model->insertGetId($attributes);
    }

    public function insertOrUpdate($conditions = [], array $attributes = []): mixed
    {
        // TODO: Implement insertOrUpdate() method.
        return $this->_model->insertOrUpdate($conditions, $attributes);
    }

    public function update($id, array $attributes = []): mixed
    {
        // TODO: Implement update() method.
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    public function delete($id): mixed
    {
        // TODO: Implement delete() method.
        $result = $this->find($id);
        if ($result) {
            $this->_model->where('id', $id)->update([
                'deleted_at' => date('Y-m-d H:i:s')
            ]);

            return true;
        }

        return false;
    }
}
