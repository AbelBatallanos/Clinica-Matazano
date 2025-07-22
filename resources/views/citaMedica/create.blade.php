@extends('layouts.dashboar.panel')

@section('content')
<h2 class="mb-4">Registrar Nueva Reserva</h2>

<form action="{{ route("crearCita") }}" method="post">
    @csrf


    <div class="mb-3">
        <label class="form-label">Fecha de Consulta</label>
        <input type="date" name="fechaconsulta" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Hora de Consulta</label>
        <input type="time" name="horaconsulta" class="form-control" required>
    </div>


    <div class="mb-3">
        <label class="form-label">Médico</label>
        <select name="medico_id" class="form-select" required>
            <option value="" selected disabled>Seleccione un médico</option>
                @forelse ($medicos as $medico )
                     <option value="{{ $medico->id }}">  {{ $medico->usuario->name." ". $medico->usuario->lastname }}</option>
                @empty
                    
                @endforelse
               
            
        </select>
    </div>
  
    <button type="submit" class="btn btn-success">Guardar Reserva</button>
    <a href="" class="btn btn-secondary">Cancelar</a>
</form>
{{ $medicos }}
@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

@endsection
