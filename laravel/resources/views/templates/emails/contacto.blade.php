<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<h1>Formulario de Contacto</h1>
	<p>{{ $datos['name'] }} ({{$datos['email']}}) tiene una consulta:</p>
	<p><strong>Telefono: </strong>{{$datos['phone']}}</p>
	<p><strong>Mensaje: </strong>{{$datos['message']}}</p>
</body>
</html>