@extends('layouts.dashboar.panel')

@section('content')
<h2 class="mb-4">Registrar Nueva Reserva</h2>

<form action="{{ route("crearCita") }}" method="post">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="name" class="form-control" required>
    </div>

     <div class="mb-3">
        <label class="form-label">Apellidos</label>
        <input type="text" name="lastname" class="form-control" required>
    </div>

     <div class="mb-3">
        <label class="form-label">Cedula de Identidad</label>
        <input type="text" name="ci" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Fecha de Consulta</label>
        <input type="date" name="fechaconsulta" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Hora de Consulta</label>
        <input type="time" name="horaconsulta" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Especialidades</label>
        <select name="especialidades" class="form-select especialidades" >
            <option value="" selected disabled>Seleccione la especialidad</option>
            
                @forelse ($especialidades as $especialidad )
                     <option value="{{ $especialidad->id }}">  {{ $especialidad->nombre}}</option>
                @empty
                    
                @endforelse
               
            
        </select>
    </div>


    <div class="mb-3">
        <label class="form-label">Médico</label>
        <select name="medico_id" class="form-select medicos" required>
            <option value="" selected disabled>Seleccione un médico</option>
            <option value="5" >prueba</option>
              
               
            
        </select>
    </div>
  
    <button type="submit" class="btn btn-success">Guardar Reserva</button>
    <a href="" class="btn btn-secondary">Cancelar</a>
</form>

@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

@push("js")
  @vite('resources/js/app.js')
@endpush

@endsection
