<?php

namespace App\Http\Controllers\Api;

use App\Repositories\AccountTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;


class AccountTypeController extends Controller
{
    use ApiResponseTrait;
    private $accountTypeRepo ;

    public function __construct(AccountTypeRepository $accountTypeRepo)
    {
        $this->accountTypeRepo = $accountTypeRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_types = $this->accountTypeRepo->findAll();
        return $this->apiResponse($account_types);
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
        $account_type = $this->accountTypeRepo->create($request->all());
        if($account_type){
            return $this->createdResponse($account_type);
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
        $account_type = $this->accountTypeRepo->find($id);
        if($account_type){
            return $this->apiResponse($account_type);
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
        $validation = $this->validation($request);
        if($validation instanceof Response){
            return $validation;
        }
        $account_type = $this->accountTypeRepo->update($request->all(),$id);
        if($account_type){
            return $this->apiResponse($account_type,null,201);
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
        $account_type = $this->accountTypeRepo->delete($id);
        if($account_type){
            return $this->deletedResponse();
        }
        return $this->unKnownError();
    }

    public function validation($request){
        return $this->apiValidation($request,[
            'name' => 'required|alpha',
        ]);
    }
}
