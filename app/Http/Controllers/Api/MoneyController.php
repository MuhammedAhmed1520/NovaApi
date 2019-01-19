<?php

namespace App\Http\Controllers\Api;

use App\Repositories\AccountRepository;
use App\Repositories\MoneyRepository;
use App\Repositories\MoneyTransferRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class MoneyController extends Controller
{

    use ApiResponseTrait;
    private $moneyRepo ;

    public function __construct(MoneyRepository $moneyRepo)
    {
        $this->moneyRepo = $moneyRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $moneys = $this->moneyRepo->findAll();
        return $this->apiResponse($moneys);
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
        $money = $this->moneyRepo->create($data);
        if($money){
            return $this->createdResponse($money);
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
        $money = $this->moneyRepo->find($id);
        if($money){
            return $this->apiResponse($money);
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
        $money = $this->moneyRepo->update($request->all(),$id);
        if($money){
            return $this->apiResponse($money,null,201);
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
        $money = $this->moneyRepo->delete($id);
        if($money){
            return $this->deletedResponse();
        }
        return $this->unKnownError();
    }

    public function validation($request){
        return $this->apiValidation($request,[
            'value' => 'required|numeric',
            'project_id' => 'required|numeric',
            'account_id' => 'required|numeric',

        ]);
    }



}
