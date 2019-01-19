<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Payment;

class PaymentRepository implements RepositoryInterface {


    public function create($data)
    {
        // TODO: Implement create() method.
        $item = Payment::create($data);
        return $item;
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
        $item = Payment::find($id);
        if(!$item){
            return false;
        }
        $item = $item->update($data);
        return $item;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.

        $item = Payment::destroy($id);
        return $item;
    }

    public function find($id)
    {
        // TODO: Implement find() method.
        $item = Payment::where('id',$id)->with(['account'])->get();
        return $item;
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
        $items = Payment::with(['account'])->get();
        return $items;
    }
}