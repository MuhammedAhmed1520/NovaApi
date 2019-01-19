<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ClientRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ClientController extends Controller
{

    use ApiResponseTrait;
    private $clientRepo ;

    public function __construct(ClientRepository $clientRepo)
    {
        $this->clientRepo = $clientRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = $this->clientRepo->findAll();
        return $this->apiResponse($clients);
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $this->validation($request);
        if($validation instanceof Response){
            return$validation;
        }
        $data = $request->all();
        $data['signature'] = $request->user()->name;
        $client = $this->clientRepo->create($data);
        if($client){
            return $this->createdResponse($client);
        }
        return $this->unKnownError();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = $this->clientRepo->find($id);
        if($client){
            return $this->apiResponse($client);
        }
        return $this->notFound();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = $this->updateValidation($request,$id);
        if($validation instanceof Response){
            return $validation;
        }
        $client = $this->clientRepo->update($request->all(),$id);
        if($client){
            return $this->apiResponse($client,null,201);
        }
        return $this->unKnownError();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $client = $this->clientRepo->delete($id);
        if($client){
            return $this->deletedResponse();
        }
        return $this->unKnownError();
    }

    public function validation($request){
        return $this->apiValidation($request,[
            'name' => 'required|alpha',
            'nickname' => 'unique:clients',
            'email' => 'email|unique:clients',
            'phone'=>'unique:clients',
        ]);
    }
    public function updateValidation($request ,$id){
        return $this->apiValidation($request,[
            'name' => 'required|alpha',
            'nickname' => 'unique:clients,nickname,'.$id,
            'email' => 'email|unique:clients,email,'.$id,
            'phone'=>'unique:clients',
        ]);
    }
}
