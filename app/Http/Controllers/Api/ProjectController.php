<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;


class ProjectController extends Controller
{
    use ApiResponseTrait;
    private $projectRepo ;

    public function __construct(ProjectRepository $projectRepo)
    {
        $this->projectRepo = $projectRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = $this->projectRepo->findAll();
        return $this->apiResponse($projects);
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
        $project = $this->projectRepo->create($data);
        if($project){
            return $this->createdResponse($project);
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
        $project = $this->projectRepo->find($id);
        if($project){
            return $this->apiResponse($project);
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
        $project = $this->projectRepo->update($request->all(),$id);
        if($project){
            return $this->apiResponse($project,null,201);
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
        $project = $this->projectRepo->delete($id);
        if($project){
            return $this->deletedResponse();
        }
        return $this->unKnownError();
    }

    public function validation($request){
        return $this->apiValidation($request,[
            'name' => 'required|alpha',
            'commission'=>'numeric',
            'link_on_freelancer'=>'url',
            'chat_link'=>'url',
            'start_date'=>'required|date',
            'end_date'=>'required|date|after_or_equal:start_date',
            'price'=>'required|numeric',
            'price_after_commission'=>'required|numeric',
            'status'=>'required|alpha',
            'project_type_id'=>'required|numeric',
            'client_id'=>'required|numeric',

        ]);
    }
}
