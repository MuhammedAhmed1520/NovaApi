<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\Client;

class ClientRepository implements RepositoryInterface {


    public function create($data)
    {
        // TODO: Implement create() method.
        $client = Client::create($data);
        return $client;
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
        $client = Client::find($id)->update($data);
        return $client;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.

        $client = Client::destroy($id);
        return $client;
    }

    public function find($id)
    {
        // TODO: Implement find() method.
        $client = Client::find($id);
        return $client;
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
        $clients = Client::all();
        return $clients;
    }
}