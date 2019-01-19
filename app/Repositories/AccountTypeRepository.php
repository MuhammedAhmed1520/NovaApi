<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\AccountType;

class AccountTypeRepository implements RepositoryInterface {


    public function create($data)
    {
        // TODO: Implement create() method.
        $account_type = AccountType::create($data);
        return $account_type;
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
        $account_type = AccountType::find($id);
        if(!$account_type){
            return false;
        }
        $account_type = $account_type->update($data);
        return $account_type;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.

        $account_type = AccountType::destroy($id);
        return $account_type;
    }

    public function find($id)
    {
        // TODO: Implement find() method.
        $account_type = AccountType::find($id);
        return $account_type;
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
        $account_types = AccountType::all();
        return $account_types;
    }
}