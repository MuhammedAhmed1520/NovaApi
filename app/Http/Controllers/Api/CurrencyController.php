<?php

namespace App\Http\Controllers\Api;

use App\Helper\UploaderHelper;
use App\Repositories\CurrencyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class CurrencyController extends Controller
{

    use ApiResponseTrait;
    use UploaderHelper;
    private $currencyRepo ;

    public function __construct(CurrencyRepository $currencyRepo)
    {
        $this->currencyRepo = $currencyRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = $this->currencyRepo->findAll();
        return $this->apiResponse($accounts);
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
        $data['logo'] = $this->imageUpload($request->file('logo'));
        $account = $this->currencyRepo->create($data);
        if($account){
            return $this->createdResponse($account);
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
        $account = $this->currencyRepo->find($id);
        if($account){
            return $this->apiResponse($account);
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
        $validation = $this->updateValidation($request);
        if($validation instanceof Response){
            return $validation;
        }

        $data = $request->all();
        if ($request->hasFile('logo')) {
            $data['logo'] = $this->imageUpload($request->file('logo'));
            unlink(public_path('/images/'.$this->currencyRepo->find($id)->logo));
        }

        $account = $this->currencyRepo->update($data,$id);
        if($account){
            return $this->apiResponse($account,null,201);
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
        $account = $this->currencyRepo->delete($id);
        if($account){
            return $this->deletedResponse();
        }
        return $this->unKnownError();
    }

    public function validation($request){
        return $this->apiValidation($request,[
            'name' => 'required|alpha',
            'shortcut' => 'required|alpha',
            'logo' => 'required|image|mimes:png| max:2048',

        ]);
    }
    public function updateValidation($request){
    return $this->apiValidation($request,[
        'name' => 'required|alpha',
        'shortcut' => 'required|alpha',
        'logo' => 'image|mimes:png| max:2048',

    ]);
}
}
