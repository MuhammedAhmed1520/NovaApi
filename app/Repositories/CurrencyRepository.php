<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Currency;

class CurrencyRepository implements RepositoryInterface {


    public function create($data)
    {
        // TODO: Implement create() method.
        $currency = Currency::create($data);
        return $currency;
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
        $currency = Currency::find($id)->update($data);
        return $currency;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.

        $currency = Currency::destroy($id);
        return $currency;
    }

    public function find($id)
    {
        // TODO: Implement find() method.
        $currency = Currency::find($id);
        return $currency;
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
        $currencies = Currency::all();
        return $currencies;
    }
}