<!DOCTYPE html>
<html>
<head>
	<title>Pedido</title>
</head>
<body>



	@foreach($pedidio as $pedidos)

Pedidio: {{$pedidos->torta_id}}



	<ul>
		<li>Cliente:{{  strtolower($pedidos->nome)}}</li>
		<li>Papel Arroz: {{ $pedidos->papelArroz}}</li>
		<li>Kg: {{ $pedidos->kg}}</li>
		<li>Cores: {{ strtolower($pedidos->cores)}}</li>
		<li>Escrever: {{strtolower( $pedidos->escrever)}}</li>
		<li>Recheio: {{ strtolower($pedidos->recheio)}}</li>

	</ul>

	@endforeach


<br>


<p>____________________________</p>
	<p style="text-align: center;">		Cliente</p>

</body>
</html>