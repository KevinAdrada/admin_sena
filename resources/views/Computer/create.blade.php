<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('computer.store')}}" method="POST" enctype="multipart/form-data">

    @csrf

    <label>
        Número:
        <input type="number" name="number">
    </label>
    <br><br>
    <label>
        Marca:
        <input type="text" name="brand">
    </label>
    <br><br>

    <button type="submit">Enviar Formulario</button>
    </form>
</body>
</html>