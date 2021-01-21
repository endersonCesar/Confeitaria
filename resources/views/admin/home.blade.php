@extends('layouts.app')

@section('content')
<div class="container">




  <div class="card" >
    <h5 class="card-header">Administração</h5>
    <div class="card-body">
      <div class="row" >

       <a href="{{ route('confirmacao.index') }}" class="text-center col-sm-3 col-md-2">
        <img src="img/pedidos.png" alt="..." class="img-thumbnail" >
        <button type="button" class="btn btn-primary">Pedidios</button>   
      </a>

      <a href="{{ route('fidelidade.index') }}" class="text-center col-sm-3 col-md-2">
        <img src="img/fidelidade.jpg" alt="..." class="img-thumbnail">
        <button type="button" class="btn btn-primary">Fidelidade</button>   
      </a>


      <a href="{{ route('usuario.index') }}" class="text-center col-sm-3 col-md-2">
        <img src="img/usuario.jpg" alt="..." class="img-thumbnail">
        <button type="button" class="btn btn-primary">Usuarios</button>   
      </a>







    </div>
  </div>
</div>



<br>



<div class="card" >
  <h5 class="card-header">Pedidios</h5>
  <div class="card-body">
    <div class="row" >



     <a href="{{ route('torta.index') }}" class="text-center col-sm-3 col-md-2">
      <img src="img/bolo.jpg" alt="..." class="img-thumbnail">
      <button type="button" class="btn btn-primary">Faça o Pedidio</button>     
    </a>



  </div>
</div>
</div>
</div>

@endsection
