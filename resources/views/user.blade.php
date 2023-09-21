<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insert clientes </title>
</head>
<body>
    <form action ="{{ route('usuarios.store') }}" method="POST">
        @csrf
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre"> 

        <label for="apellido">Apellido</label>
        <input type="text" name="apellido" id="apellido"> 

        <label for="telefono">Telefono</label>
        <input type="number" name="telefono" id="telefono"> 

        <label for="correo">Correo</label>
        <input type="text" name="correo" id="correo"> 

        <label for="clave">Clave</label>
        <input type="text" name="clave" id="clave"> 

        <label for="direccion">Direccion</label>
        <input type="adress" name="direccion" id="direccion"> 

        <label for="ciudad">Ciudad</label>
        <input type="text" name="ciudad" id="ciudad"> 

        <label for="departamento">Departamento</label>
        <input type="text" name="departamento" id="departamento"> 

        <label for="cedula">Cedula</label>
        <input type="number" name="cedula" id="cedula"> 

        <label for="zona">Zona</label>
        <input type="text" name="zona" id="zona"> 

        <label for="id_rol">rol</label>
        <input type="text" name="id_rol" id="id_rol"> 

        <button type="submit">Guardar</button>
</form>
</body>
</html>