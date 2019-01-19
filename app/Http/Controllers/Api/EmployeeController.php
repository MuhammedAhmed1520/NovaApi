<?php

namespace App\Http\Controllers\Api;

use App\Repositories\EmployeeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{

    use ApiResponseTrait;
    private $employeeRepo ;

    public function __construct(EmployeeRepository $employeeRepo)
    {
        $this->employeeRepo = $employeeRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = $this->employeeRepo->findAll();
        return $this->apiResponse($employees);
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
        $employee = $this->employeeRepo->create($data);
        if($employee){
            return $this->createdResponse($employee);
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
        $employee = $this->employeeRepo->find($id);
        if($employee){
            return $this->apiResponse($employee);
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
        $employee = $this->employeeRepo->update($request->all(),$id);
        if($employee){
            return $this->apiResponse($employee,null,201);
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
        $employee = $this->employeeRepo->delete($id);
        if($employee){
            return $this->deletedResponse();
        }
        return $this->unKnownError();
    }

    public function validation($request){
        return $this->apiValidation($request,[
            'name' => 'required|alpha',
            'email' => 'required|email|unique:employees',
            'phone'=>'required|regex:/(01)[0-9]{9}/|unique:employees',
        ]);
    }

    public function updateValidation($request,$id){
        return $this->apiValidation($request,[
            'name' => 'required|alpha',
            'email' => 'required|email|unique:employees,email,'.$id,
            'phone'=>'required|regex:/(01)[0-9]{9}/|unique:employees,phone,'.$id,
        ]);
    }
}
