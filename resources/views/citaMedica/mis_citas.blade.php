
@extends("layouts.dashboar.panel")

@section("content")

<div class="table-responsive">
  <table class="table table-bordered table-hover align-middle text-center">
    <thead class="table-secondary">
      <tr>
        <th>Fecha-Consulta</th>
        <th>hora-Consulta</th>
        <th>Medico</th>
        <th>Estado</th>
        <th>Estado-pago</th>
        <th>Fecha-Creada</th>
        <th>Acciones</th>

      </tr>
    </thead>
    <tbody class="table-striped table-light">

        @forelse ($citas as $cita)
        <tr>    
            
            <td>{{ $cita->fechaconsulta }}</td>
            <td>{{ $cita->horaconsulta }}</td>
            <td>{{ "Any" }}</td>
            
            <td>{{ $cita->estado }}</td>
            <td>{{ $cita->estadopago }}</td>
            <td>{{ "Creacion" }}</td>
            <td>{{ "acciones" }}</td>
            
            @empty

        </tr>
        @endforelse
    </tbody>
  </table>
</div>
@endsection