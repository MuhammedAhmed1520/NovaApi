<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\MoneyTransfers;

class MoneyTransferRepository implements RepositoryInterface {


    public function create($data)
    {
        // TODO: Implement create() method.
        $money = MoneyTransfers::create($data);
        return $money;
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
        $money = MoneyTransfers::find($id)->update($data);
        return $money;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.

        $money = MoneyTransfers::destroy($id);
        return $money;
    }

    public function find($id)
    {
        // TODO: Implement find() method.
        $money = MoneyTransfers::where('id',$id)->with(['from','to'])->get();
        return $money;
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
        $moneys = MoneyTransfers::with(['from','to'])->get();
        return $moneys;
    }
}