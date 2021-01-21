@extends('layouts.app')

@section('content')

@push('scripts')

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script> 

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">





<script type="text/javascript">

  $('button[type=button][name=editar]').on('click', function() {
    $('input[name=id_pedido]').val($(this).attr('pedido'));
    $('#modalExemplo').modal('show');
  });



  $('button[type=button][name=imprimir]').on('click', function() {
    var buscar= $(this).attr('pedido')
    

       window.open('./confirmacao/imprimir/'+buscar,'_blank');
  });


</script>




@endpush
<div class="container">

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
      <li class="breadcrumb-item"><a href="">Confirmar Pedido</a></li>
    </ol>
  </nav>


  <div class="card" >
    <h5 class="card-header">Confirmação de Pedidos</h5>
    <div class="card-body">


      <div class="col">

       <table class="table table-striped">
        <thead>
          <tr>

            <th scope="col">Cliente</th>
            <th scope="col">Telefone</th>
            <th scope="col">Kg</th>
            <th scope="col">Data</th>
            <th scope="col">Massa</th>
            <th scope="col">Papel Arroz</th>
            <th scope="col">Cores</th>
            <th scope="col">Escrever</th>
            <th scope="col">Status do Pedido</th>
            <th scope="col">Imprimir</th>
          </tr>
        </thead>
        <tbody>
          @foreach($torta as $pedido)
          <tr>

            <td>{{$pedido->nome}}</td>
            <td>{{$pedido->telefone}}</td>
            <td>{{$pedido->kg}}</td>
            <td>{{$pedido->data}}</td>
            <td>{{$pedido->massa}}</td>
            <td>{{$pedido->papelArroz}}</td>
            <td>{{$pedido->cores}}</td>
            <td>{{$pedido->escrever}}</td>
            @if($pedido->status_id==1)
            <td><button type="button" name="editar" class="btn btn-danger" pedido="{{$pedido->torta_id}}" status ="{{$pedido->status_id}}">{{$pedido->status}}</button></td>
            @endif
            @if($pedido->status_id==2)
            <td><button type="button" name="editar" class="btn btn-info" pedido="{{$pedido->torta_id}}" status ="{{$pedido->status_id}}">{{$pedido->status}}</button></td>
            @endif
            @if($pedido->status_id==3)
            <td><button type="button" name="editar" class="btn btn-success" pedido="{{$pedido->torta_id}}" status ="{{$pedido->status_id}}">{{$pedido->status}}</button></td>
            @endif
            @if($pedido->status_id==4)
            <td><button type="button" name="editar" class="btn btn-success" pedido="{{$pedido->torta_id}}" status ="{{$pedido->status_id}}">{{$pedido->status}}</button></td>
            @endif

            <td><button type="button" name="imprimir" class="btn btn-success" pedido="{{$pedido->torta_id}}" status ="{{$pedido->status_id}}">imprimir</button></td>
          </tr>
          @endforeach

        </tbody>
      </table>

    </div>



  </div>
</div>
</div>



<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alterar Status do Pedido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{route('confirmacao.store')}}"  enctype="multipart/form-data" >
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ; ?>">
        <div class="modal-body">


          <input type="hidden" name="id_pedido">
          <select class="form-control" name="status">
            <option></option>
            @foreach($status as $id)
            <option value="{{$id->id}}">{{$id->status}}</option>
            @endforeach
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Alterar</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection