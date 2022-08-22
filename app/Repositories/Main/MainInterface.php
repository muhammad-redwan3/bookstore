<?php

namespace App\Repositories\Main;

interface MainInterface
{
    public function all();
    public function store($request);
    public function update($request,$id);
    public function getById($id);
    public function delete($id);
}
