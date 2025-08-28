

<h1> Historial Clinico </h1>


@foreach ($historiales as $historial)
    <p>fecha consulta : {{ historial["fecha_consulta"] }}</p>
    <p>doctor: {{ historial["doctor"] }}</p>
    <p>{{ historial["diagnostico"] }}</p>
    <p>{{ historial["receta"] }}</p>
    <p>{{ historial["observaciones"] }}</p>
@endforeach

