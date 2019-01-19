<?php

namespace App\Http\Controllers\Api;

use App\Repositories\AccountRepository;
use App\Repositories\DiscountRepository;
use App\Repositories\DiscountTransferRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class DiscountController extends Controller
{

    use ApiResponseTrait;
    private $discountRepo ;

    public function __construct(DiscountRepository $discountRepo)
    {
        $this->discountRepo = $discountRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = $this->discountRepo->findAll();
        return $this->apiResponse($discounts);
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
        $discount = $this->discountRepo->create($data);
        if($discount){
            return $this->createdResponse($discount);
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
        $discount = $this->discountRepo->find($id);
        if($discount){
            return $this->apiResponse($discount);
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
        $discount = $this->discountRepo->update($request->all(),$id);
        if($discount){
            return $this->apiResponse($discount,null,201);
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
        $discount = $this->discountRepo->delete($id);
        if($discount){
            return $this->deletedResponse();
        }
        return $this->unKnownError();
    }

    public function validation($request){
        return $this->apiValidation($request,[
            'value' => 'required|numeric',
            'project_id' => 'required|numeric|unique:discounts,project_id',
            'account_id' => 'required|numeric',

        ]);
    }
    public function updateValidation($request,$id){
        return $this->apiValidation($request,[
            'value' => 'required|numeric',
            'project_id' => 'required|numeric|unique:discounts,project_id,'.$id,
            'account_id' => 'required|numeric',

        ]);
    }



}
