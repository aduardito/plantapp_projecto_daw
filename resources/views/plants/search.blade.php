<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Busca plantas</title>
</head>
<body>
    @if($plant_category)
        <h2>El nombre de la planta es: {{ $plant_name }}</h2>
        <h2>La categoría de la planta es: {{ $plant_category }}</h2>
    @else
        <h2>El nombre de la planta es: {{ $plant_name }}</h2>
    @endif
</body>
</html>