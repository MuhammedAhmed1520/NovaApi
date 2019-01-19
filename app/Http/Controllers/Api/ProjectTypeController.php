<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ProjectTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;


class ProjectTypeController extends Controller
{
    use ApiResponseTrait;
    private $projectTypeRepo ;

    public function __construct(ProjectTypeRepository $projectTypeRepo)
    {
        $this->projectTypeRepo = $projectTypeRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project_types = $this->projectTypeRepo->findAll();
        return $this->apiResponse($project_types);
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
        $project_type = $this->projectTypeRepo->create($data);

        if($project_type){
            return $this->createdResponse($project_type);
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
        $project_type = $this->projectTypeRepo->find($id);
        if($project_type){
            return $this->apiResponse($project_type);
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
        $project_type = $this->projectTypeRepo->update($request->all(),$id);
        if($project_type){
            return $this->apiResponse($project_type,null,201);
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
        $project_type = $this->projectTypeRepo->delete($id);
        if($project_type){
            return $this->deletedResponse();
        }
        return $this->unKnownError();
    }

    public function validation($request){
        return $this->apiValidation($request,[
            'name' => 'required|alpha',
            'commission'=>'numeric',
        ]);
    }
}
