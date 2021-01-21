<?php

namespace App\Http\Controllers\ConfirmacaoPedido;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Recheios;
use App\Model\Torta;
use App\Model\SalvaRecehioTorta;
use App\Model\Status;
use App\Model\StatusPedido;
use Illuminate\Support\Facades\DB;
use PDF;
class ConfirmacaoPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $torta = DB::select("select
            nome, telefone, kg, data, massa, papelArroz, cores, escrever,statuses.status,tortas.id as torta_id,statuses.id as status_id
            from
            tortas 
            join salva_recehio_tortas on
            salva_recehio_tortas.tortas_id = tortas.id
            join recheios on
            salva_recehio_tortas.recheios_id = recheios.id
            join status_pedidos on
            status_pedidos.tortas_id = tortas.id
            join statuses on
            statuses.id = status_pedidos.status_id
            order by status_id
            ");
        $status = Status::all();
        return view('admin/confirmacaoPedido',compact('torta','status'));
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
      $id_pedido = $request->input('id_pedido');
      $id_status = $request->input('status');
      $id = DB::table('status_pedidos')->where('tortas_id',$id_pedido)->first();
      $pedidio = StatusPedido::find($id->id);
      $pedidio->status_id =  $id_status;
      $pedidio->save();
      return redirect()->route('confirmacao.index')->with('cadastro','Pedido Realisado com Sucesso');
    //  $pedidio  = Torta::findOrFail();
  }

  public function imprimir($id){

     $data['pedidio']=DB::select("select
    nome,
    telefone,
    kg,
    data,
    massa,
    papelArroz,
    cores,
    escrever,
    statuses.status,
    tortas.id as torta_id,
    statuses.id as status_id,
    recheios.recheio 
from
    tortas
join salva_recehio_tortas on
    salva_recehio_tortas.tortas_id = tortas.id
join recheios on
    salva_recehio_tortas.recheios_id = recheios.id
join status_pedidos on
    status_pedidos.tortas_id = tortas.id
join statuses on
    statuses.id = status_pedidos.status_id
where
    tortas.id =$id
order by
    status_id");
   
  return PDF::loadView('relatorio/impressao',$data)->setPaper([0, 0, 300.374, 221.102], 'landscape')->stream();

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
