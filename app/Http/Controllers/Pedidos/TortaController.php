<?php

namespace App\Http\Controllers\Pedidos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Recheios;
use App\Model\Torta;
use App\Model\SalvaRecehioTorta;
use App\Model\StatusPedido;
class TortaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$recheios = Recheios::all();
    	
    	
    	return view('pedidos/torta',compact('recheios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$recheios = Recheios::all();
    	
    	
    	return view('pedidos/torta',compact('recheios'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$torta = new Torta;
    	$torta->nome = $request->input('nome');
    	$torta->telefone = $request->input('telefone');
    	$torta->kg = $request->input('kg');
    	$torta->data = $request->input('data');
    	$torta->massa = $request->input('tipo_massa');
    	$torta->papelArroz = $request->input('papelArroz');
    	$torta->cores = $request->input('cores');
    	$torta->escrever = $request->input('escrever');
    	$torta->save();

    	$salva_recheio_torta = new SalvaRecehioTorta;

    	$recheio = $request->input('recheio');

    	foreach ($recheio as $id) {

    		$salva_recheio_torta->recheios_id = $id;
    		$salva_recheio_torta->tortas_id = $torta->id;
    		$salva_recheio_torta->save();
    	}
        $status = new StatusPedido;
        $status->status_id = 1;
        $status->tortas_id =  $torta->id;
        $status->save();
        return redirect()->route('torta.index')->with('cadastro','Pedido Realisado com Sucesso');
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
        //
    }
}
