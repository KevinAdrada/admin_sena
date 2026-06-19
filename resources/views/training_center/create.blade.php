<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('training_center.store')}}" method="POST" enctype="multipart/form-data">

    @csrf

    <label>
        Nombre:
        <input type="text" name="name">
    </label>
    <br><br>
    <label>
        Ubicación:
        <input type="text" name="location">
    </label>
    <br><br>

    <button type="submit">Enviar Formulario</button>
    </form>
</body>
</html>