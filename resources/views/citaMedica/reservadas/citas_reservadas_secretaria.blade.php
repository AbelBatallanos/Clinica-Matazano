
@extends("layouts.dashboar.panel")

@section("content")

<div class="table-responsive">
  <table class="table table-bordered table-hover align-middle text-center">
    <thead class="table-secondary">
      <tr>
        <th>Paciente</th>
        <th>Fecha-Consulta</th>
        <th>hora-Consulta</th>
        <th>Medico</th>
        <th>N°Consultorio</th>
        <th>Especialidad</th>
        <th>Estado</th>
        <th>Estado-pago</th>
        <th>Fecha-Creada</th>
        <th>Acciones</th>

      </tr>
    </thead>
    <tbody class="table-striped table-light">
      
        @forelse ($datos as $cita)
        <tr>    
            <td>{{ $cita["paciente"] }}</td>
            <td>{{ $cita["fconsulta"] }}</td>
            <td>{{ $cita["hconsulta"] }}</td>
            <td>{{ $cita["medico"] }}</td>
            <td>{{ $cita["consultorio"] }}</td>
            <td>{{ $cita["especialidad"] }}</td>
            <td>{{ $cita["estado"] }}</td>
            <td>{{ $cita["estadopago"] }}</td>
            <td>{{ $cita["fcreacion"] }}</td>
            <td>{{ "ACCIONES" }}</td>
            @empty

        </tr>
        @endforelse
    </tbody>
  </table>
</div>
@endsection