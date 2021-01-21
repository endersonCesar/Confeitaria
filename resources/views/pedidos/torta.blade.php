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
		<h5 class="card-header">Torta</h5>
		<div class="card-body">


			<form method="post" action="{{ route('torta.store') }}"  enctype="multipart/form-data" >
				<input type = "hidden" name = "_token" value = "<?php echo csrf_token() ; ?>">
				<div class="row" align="center" >

					<div class="col">

						<input  type="text" name="nome"  class="form-control maiusculo" placeholder="Nome Completo"> 
					</div>
					<div class="col">
						<input   type="text" name="telefone"  class="form-control phone" placeholder="Telefone"> 
					</div>



				</div>
				<hr style="border-top: solid rgba(0,0,0,0.1);" /> 
				<div  class="row" align="center">
					<div class="col">

						<input   type="text" name="kg"  class="form-control " placeholder="Kg"> 
					</div>
					<div class="col">
						
						<input   type="text" name="data" id="data" class="form-control  " placeholder="Data"> 
					</div>
				</div>
				<hr style="border-top: solid rgba(0,0,0,0.1);" /> 
				<div class="row" align="center" >

					<div class="col">

						<select class="form-control" name="tipo_massa" >
							<option disabled selected>Tipo da Massa</option>
							<option value="Branca">Branca</option>
							<option value="Chocolate">Chocolate</option>
						</select>
					</div>
					<div class="col">
						
						<select class="selectpicker" data-live-search="true" title="" multiple="true"  name="recheio[]" id="cliente_select" title="" >
							<option disabled selected>Recheio: Pode Escolher 3 Opções</option>
							@foreach($recheios as $recheio)
							<option value="{{$recheio->id}}">{{$recheio->recheio}}</option>
							@endforeach
						</select>
					</div>
					<div class="col">

						<select class="form-control" title="Papel Arroz" name="papelArroz">
							<option disabled selected>Papel Arroz</option>
							<option value="Sim"> Sim</option>
							<option value="Não"> Não</option>
						</select>
					</div>
				</div>
				<hr style="border-top: solid rgba(0,0,0,0.1);" /> 
				<div class="row" align="center" >

					<div class="col">

						<input   type="text" name="cores"  class="form-control maiusculo" placeholder="Cores" >
					</div>
					<div class="col">
						
						<input  placeholder="Escrever"  type="text" name="escrever"  class="form-control maiusculo">
					</div>

				</div>
				<hr style="border-top: solid rgba(0,0,0,0.1);" /> 
				<div class="row" align="center" >
					<div class="col">
						<button type="submit" class="btn btn-primary">Encaminhar Pedido</button>
					</div>
				</div>

			</form>



		</div>

	</div>
</div>



@endsection
