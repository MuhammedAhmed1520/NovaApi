<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Discount;

class DiscountRepository implements RepositoryInterface {


    public function create($data)
    {
        // TODO: Implement create() method.
        $item = Discount::create($data);
        return $item;
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
        $item = Discount::find($id);
        if(!$item){
            return false;
        }
        $item = $item->update($data);
        return $item;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.

        $item = Discount::destroy($id);
        return $item;
    }

    public function find($id)
    {
        // TODO: Implement find() method.
        $item = Discount::where('id',$id)->with(['project','account'])->get();
        return $item;
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
        $items = Discount::with(['project','account'])->get();
        return $items;
    }
}