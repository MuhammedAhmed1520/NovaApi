<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Money;

class MoneyRepository implements RepositoryInterface {


    public function create($data)
    {
        // TODO: Implement create() method.
        $item = Money::create($data);
        return $item;
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
        $item = Money::find($id);
        if(!$item){
            return false;
        }
        $item = $item->update($data);
        return $item;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.

        $item = Money::destroy($id);
        return $item;
    }

    public function find($id)
    {
        // TODO: Implement find() method.
        $item = Money::where('id',$id)->with(['project','account'])->get();
        return $item;
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
        $items = Money::with(['project','account'])->get();
        return $items;
    }
}