@extends("layouts.dashboar.panel")

{{-- {{ $historiales }} --}}
@section("content")

<div class="table-responsive">
  <table class="table table-bordered table-hover align-middle text-center">
    <thead class="table-secondary">
      <tr>
        <th>ID</th>
        <th>Paciente</th>
        <th>fechacreacion</th>
        <th>horacreacion</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody class="table-striped table-light">
       
        @forelse ($historiales as $histClinico)
        <tr>    
          <td>{{ $histClinico["historia_id"] }}</td>
          <td>{{ $histClinico["nombre"]." ".$histClinico["apellidos"] }}</td>
          <td>{{ $histClinico["fechacreada"] }}</td>
          <td>{{ $histClinico["horacreada"] }}</td>
      
          <td>
            <button>CLick</button>
            <button>CLick2</button>
          </td>
        </tr>
            @empty

        @endforelse
    </tbody>
  </table>
</div>
@endsection 