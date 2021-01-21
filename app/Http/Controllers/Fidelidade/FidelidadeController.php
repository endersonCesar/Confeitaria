<?php

namespace App\Http\Controllers\Fidelidade;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Pontuacao;
use Illuminate\Support\Facades\DB;
class FidelidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pontos = Pontuacao::all();
        return view ('fidelidade/fidelidade',compact('pontos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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

        $cpf = $request->input('cpf');

        

        $achou = DB::table('pontuacaos')->where('cpf', $cpf)->first();

        if(empty($achou)){
           $pontuacao = new Pontuacao;

           $validatedData =$request->validate([
            'cpf' => 'unique:pontuacaos'
        ]);


           $pontuacao->cliente = $request->input('nome');
           $pontuacao->cpf= $request->input('cpf');
           $pontuacao->valor= $request->input('valor');
           $pontuacao->pontos= $request->input('pontos');
           $pontuacao->save();
           return redirect()->route('fidelidade.index')->with('cadastro','Pontos Cadastrados Com Sucesso');
       }else{

        $pontuacao  = Pontuacao::find($achou->id);
        $pontuacao->cliente = $request->input('nome');
        $pontuacao->cpf= $request->input('cpf');
        $pontuacao->valor= $request->input('valor');
        $pontuacao->pontos= $request->input('pontos');
        $pontuacao->save();
        return redirect()->route('fidelidade.index')->with('cadastro','Pontos Cadastrados Com Sucesso');
        
    }


}

public function buscaNome(Request $request){

   $nome = $request->input('term');

   $result = DB::select("select cliente as label from pontuacaos where cliente like '%$nome%'");


   return response()->json($result);


}

public function buscaCpf(Request $request){

   $nome = $request->input('nome');

   $result = DB::select("select cpf,pontos from pontuacaos where cliente like '%$nome%'");

   return response()->json($result);
}



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $pontuacao  = Pontuacao::findOrFail($id);
        $pontuacao->delete();
          return redirect()->route('fidelidade.index')->with('excluir','Pontuação Excluida com Sucesso');
    }
}
