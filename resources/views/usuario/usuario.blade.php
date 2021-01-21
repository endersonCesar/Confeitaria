@extends('layouts.app')

@section('content')

@push('scripts')

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script> 


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>





<script type="text/javascript">

	$('select').selectpicker();
	
	$(".maiusculo").change(function(){

		$(this).val($(this).val().toUpperCase());
	});

	$('button[type=button][name=alterar]').on('click',function(){

		var busca = {
			id:$(this).attr('valor')
		}


		$.ajax({
			url:'./usuario/buscarNome',
			type: "POST",
			dataType: "JSON",
			data: busca,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function (data) {
				



			}

		});






	});


	var behavior = function (val) {
		return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
	options = {
		onKeyPress: function (val, e, field, options) {
			field.mask(behavior.apply({}, arguments), options);
		}
	};

	$('.phone').mask(behavior, options);

	$("#data").datepicker({
		dateFormat: 'dd/mm/yy',
		dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
		dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
		dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
		monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
		monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
		nextText: 'Próximo',
		prevText: 'Anterior',
		onSelect: function (dateText, inst) {
			$('#data').val(dateText);
		}
	});








</script>




@endpush





<div class="container">


	@if (session('cadastro'))
	<div class="alert alert-success">
		{{ session('cadastro') }}
		<button type="button" class="close"  aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@endif


	<div class="card" >
		<h5 class="card-header">Novo Usuario</h5>
		<div class="card-body">

			<form method="post" action="{{ route('usuario.store') }}"  enctype="multipart/form-data" >
				<input type = "hidden" name = "_token" value = "<?php echo csrf_token() ; ?>">
				<div class="row" align="center" >

					<div class="col">
						<label>Nome Completo</label>
						<input  type="text" name="nome"  id="nome" class="form-control maiusculo" placeholder="Nome Completo" required="true"> 
					</div>
					<div class="col">
						<label>Email</label>
						<input type="email" name="email" required="true" id="email"  class="form-control " placeholder="Email"> 
					</div>
					<div class="col">
						<label>Senha</label>
						<input type="password" name="senha" required="true" id="senha" class="form-control" placeholder="Senha"> 


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
				<table class="table">
					<thead class="thead-dark">
						<tr>

							<th scope="col">Nome</th>
							<th scope="col">Email</th>
							<th scope="col">Alterar</th>
							<th scope="col">Excluir</th>


						</tr>
					</thead>
					<tbody>
						@foreach($user as $nome)
						<tr>
							<td>{{$nome->name}}</td>
							<td>{{$nome->email}}</td>
							
							<td> <button type="button" name="alterar" valor="{{$nome->id}}"class="btn btn-primary">Alterar</button>   </td>           
							
							<form action="{{route('usuario.destroy',[$nome->id])}}" method="POST">
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
