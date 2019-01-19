<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Account;

class AccountRepository implements RepositoryInterface {


    public function create($data)
    {
        // TODO: Implement create() method.
        $account = Account::create($data);
        return $account;
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
        $account = Account::find($id)->update($data);
        return $account;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.

        $account = Account::destroy($id);
        return $account;
    }

    public function find($id)
    {
        // TODO: Implement find() method.
        $account = Account::where('id',$id)->with('type')->get();
        return $account;
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
        $accounts = Account::with('type')->get();
        return $accounts;
    }
}