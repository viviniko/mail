<?php

namespace Viviniko\Mail\Repositories\Template;

interface TemplateRepository
{
    /**
     * Get all data.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all();

    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

    /**
     * Get mail template by key.
     *
     * @param string $key
     * @return null|Template
     */
    public function findByKey($key);
}