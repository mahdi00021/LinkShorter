<?php

namespace Application\Repository;

interface IRepository
{
    public function find($url);

    public function create($url, $date);

    public function delete($short_code);

    public function update($short_code, $url);
}