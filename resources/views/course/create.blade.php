<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('course.store')}}" method="POST" enctype="multipart/form-data">

    @csrf

    <label>
        Numero de Curso: 
        <input type="number" name="course_number">
    </label>
    <br><br>
    <label>
        day: 
        <input type="date" name="day">
    </label>
    <br><br>

    <label for="area_id">Area: </label>
        <select name="area_id" id="area_id" class="form-control">
            <option value="">Selecione area</option>
            @foreach($areas as $area)
                <option value="{{$area->id}}">
                    {{$area->name}}
                </option>
            @endforeach

        </select>

        <br><br>
    <label for="training_center_id">Centro de Formacion: </label>
        <select name="training_center_id" id="training_center_id" class="form-control">
            <option value="">Selecione un centro de formacion</option>
            @foreach($training_centers as $training_center)
                <option value="{{$training_center->id}}">
                    {{$training_center->name}}
                </option>
            @endforeach

        </select>
        <br><br>
        


    <button type="submit">Enviar Formulario</button>
    </form>
</body>
</html>

