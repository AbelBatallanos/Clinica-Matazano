
<h1> HISTORIALES CLINICOS </h1>

{{ auth()->user()->pacientes }}

@forelse ($histClinicos as $historialClinico )
        <p>{{ $historialClinico }}</p>
@empty
    
@endforelse