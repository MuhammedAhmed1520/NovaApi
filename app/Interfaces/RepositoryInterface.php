<?php
namespace App\Interfaces;

interface RepositoryInterface{


     public function create($data);

     public function update($data,$id);

     public function delete($id);

     public function find($id);

     public function findAll();
}