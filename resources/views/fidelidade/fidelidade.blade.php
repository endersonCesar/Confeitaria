@extends('layouts.app')

@section('content')


@push('scripts')
<script src="https://code.jquery.com/jquery-1.10.0.min.js"></script>
<script src="https://rawgit.com/RobinHerbots/Inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>




<script type="text/javascript">




  $("input[id*='cpf']").inputmask({
    mask: ['999.999.999-99'],
    keepStatic: true
  });


  $("#valor").inputmask('decimal', {
    'alias': 'numeric',
    'groupSeparator': ',',
    'autoGroup': true,
    'digits': 2,
    'radixPoint': ".",
    'digitsOptional': false,
    'allowMinus': false,
    'prefix': 'R$ ',
    'placeholder': ''
  });


  $(".maiusculo").change(function(){

    $(this).val($(this).val().toUpperCase());
  });



  $('.nome').autocomplete({
    minLength: 1,
    delay: 50,
    source: function (request, response) {
      request['nome'] = $('input[name=nome]').val();


      $.ajax({
        url: './fidelidade/buscaNome',
        data: request,
        dataType: 'json',
        type: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
          response(data);
        }
      });
    }


  });


  $("#nome").focusout(function(){
    var busca ={
      nome:$(this).val(),
    }

    $.ajax({
      url: './fidelidade/buscaCpf',
      data: busca,
      dataType: 'json',
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (data) {
        for (var i = 0; i < data.length; i++) {
          $('input[name=cpf]').val(data[i]['cpf']);
          $('input[name=pontosTotais]').val(data[i]['pontos']);
        }
        
      }
    });
  });


</script>




@endpush


<div class="container">


  @if (session('excluir'))
  <div class="alert alert-danger">
    {{ session('excluir') }}
    <button type="button" class="close"  aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif


  @if (session('cadastro'))
  <div class="alert alert-success">
    {{ session('cadastro') }}
    <button type="button" class="close"  aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif

  @if (isset($errors) && $errors->any())
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
      <li class="breadcrumb-item"><a href="">Fidelidade</a></li>
    </ol>
  </nav>

  <div class="card" >
    <h5 class="card-header">Torta</h5>
    <div class="card-body">
      <form method="post" action="{{ route('fidelidade.store') }}"  enctype="multipart/form-data" >
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ; ?>">
        <div class="row" align="center" >

          <div class="col">
            <label>Nome Completo</label>
            <input  type="text" name="nome"  id="nome" class="form-control maiusculo nome" placeholder="Nome Completo" required="true"> 
          </div>
          <div class="col">
           <label>CPF</label>
           <input   type="text" name="cpf" required="true" id="cpf"  class="form-control " placeholder="CPF"> 
         </div>
         <div class="col">
          <label>Valor</label>
          <input   type="text" name="valor" required="true" id="valor" class="form-control" placeholder="Valor Gasto"> 


        </div>
      </div>
      <hr style="border-top: solid rgba(0,0,0,0.1);" /> 
      <div class="row" align="center" >
        <div class="col">
          <label>Pontos</label>
          <input   type="text" name="pontos"  required="true" id="pontos" class="form-control" placeholder="Pontos"> 
        </div>
        <div class="col">
          <label>Pontos Totais</label>
          <input   type="text" name="pontosTotais" disabled="true"  id="pontosTotais" class="form-control" placeholder="Pontos"> 
        </div>
      </div>


      <hr style="border-top: solid rgba(0,0,0,0.1);" /> 
      <div class="row" align="center" >
        <div class="col">
          <button type="submit" class="btn btn-primary">Lançar</button>
        </div>
      </div>
    </form>
    <hr style="border-top: solid rgba(0,0,0,0.1);" /> 



    <div class="row" align="center" >
     <table class="table table-bordered">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Nome</th>
          <th scope="col">CPF</th>
          <th scope="col">Pontos</th>
          <th scope="col">Excluir</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pontos as $ponto)
        <tr>

          <td>{{$ponto->cliente}}</td>
          <td>{{$ponto->cpf}}</td>
          <td>{{$ponto->pontos}}</td>
          <form action="{{route('fidelidade.destroy',[$ponto->id])}}" method="POST">
           @method('DELETE')
           @csrf
           <td> <button type="submit" class="btn btn-danger">Excluir</button>     </td>           
         </form>

       </tr>
       @endforeach

     </tbody>
   </table>
 </div>

</div>




</div>
</div>

@endsection
