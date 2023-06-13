<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClasseRequest;
use App\Models\Classe;
use Illuminate\Http\Request;
use App\Http\Response\ResponseJson;

class ClasseController extends Controller
{
    use ResponseJson;
    public function index(){
        $classe = Classe::all();
        return $this->response_json($classe, 200, "All courses were showed.");
    }

    public function store(ClasseRequest $request){
        $data = $request->all();
        $classe = Classe::create($data);
        return $this->response_json($classe, 201, "Classe criado com sucesso.");
    }

    public function show($id){
        $classe = Classe::findOrFail($id);
        if(!$classe){
            return $this->response_json(null, 404, "Classe not found.");
        }
        return $this->response_json($classe, 200, "Classe criado com sucesso.");
    }
}
