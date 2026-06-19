<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('apprentice.store')}}" method="POST" enctype="multipart/form-data">

    @csrf

    <label>
        Nombre:
        <input type="text" name="name">
    </label>
    <br><br>
    <label>
        Correo electronico:
        <input type="email" name="email">
    </label>
    <br><br>
    <label>
        Numero de telefono:
        <input type="number" name="cell_number">
    </label>
    <br>
    <br>

    <label for="course_id">Curso: </label>
        <select name="course_id" id="course_id" class="form-control">
            <option value="">Selecione un curso</option>
            @foreach($courses as $course)
                <option value="{{$course->id}}">
                    {{$course->course_number}}
                </option>
            @endforeach

        </select>

        <br><br>
    <label for="computer_id">Equipo: </label>
        <select name="computer_id" id="computer_id" class="form-control">
            <option value="">Selecione un equipo</option>
            @foreach($computers as $computer)
                <option value="{{$computer->id}}">
                    {{$computer->number}}
                </option>
            @endforeach

        </select>

        <br><br>


    <button type="submit">Enviar Formulario</button>
    </form>
</body>
</html>