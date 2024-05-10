<?php

namespace App\Repositories;

use App\Enums\PaginateEnum;

abstract class EloquentRepository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $_model;

    /**
     * EloquentRepository constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get model
     *
     * @return string
     */
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel(): void
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Get All
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->_model->all();
    }

    /**
     * Get All
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllPaginate()
    {
        return $this->_model->paginate(PaginateEnum::Limit);
    }

    /**
     * Get one
     *
     * @param $id
     *
     * @return mixed
     */
    public function find(int $id)
    {
        $result = $this->_model->find($id);

        return $result;
    }

    /**
     * Create
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->_model->create($attributes);
    }

    /**
     * Update
     *
     * @param $id
     * @param array $attributes
     *
     * @return bool|mixed
     */
    public function update(int $id, array $attributes)
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    /**
     * Delete
     *
     * @param $id
     *
     * @return bool
     */
    public function delete(int $id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }
}
