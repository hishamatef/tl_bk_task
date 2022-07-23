<?php

namespace App\Http\Interfaces;


interface CrudInterface
{
    public function all();
    public function store(array $request);
    public function update(array $request, $id);
}
