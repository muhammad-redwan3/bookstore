<?php

namespace App\Repositories\Publishers;

use App\Models\Publisher;

Class PublisherRepository implements PublisherInterface
{
    private $Publisher;
    public function __construct(Publisher $Publisher)
    {
        $this->Publisher = $Publisher;
    }
    public function all()
    {
        return  $this->Publisher::withCount('books')->paginate(12)->sortBy('name');
    }

    public function store($request)
    {
        return $this->Publisher::create($this->extract($request));
    }

    public function update($request, $id)
    {
        return $this->getById($id)->update($this->extract($request));
    }

    public function getById($id)
    {
        return $this->Publisher->findOrFail($id);
    }

    public function delete($id)
    {
        return $this->getById($id)->delete();
    }

    public function search($request)
    {
        return $this->Publisher->withCount('books')->where('name','like',"%{$request}%")->paginate(12);
    }

    private function extract($request): array
    {
        return [
            'name' =>$request->name,
            'address' =>$request->address,
        ];
    }
}
