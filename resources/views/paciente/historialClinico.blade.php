@extends("layouts.dashboar.panel")

{{ $histClinicos }}
@section("content")

<div class="table-responsive">
  <table class="table table-bordered table-hover align-middle text-center">
    <thead class="table-secondary">
      <tr>
        <th>ID</th>
        <th>fechacreacion</th>
        <th>horacreacion</th>
        <th>paciente</th>
      </tr>
    </thead>
    <tbody class="table-striped table-light">
        {{ $histClinicos }}
        {{-- @forelse ($histClinicos as $histClinico)
        <tr>    
            <td>{{ $histClinico->id }}</td>
            <td>{{ $histClinico->nameuser }}</td>
            <td>{{ $histClinico->name }}</td>
            <td>{{ $histClinico->lastname }}</td>
            <td>{{ $histClinico->email }}</td>
            <td>{{ $histClinico->ci }}</td>
            <td>{{ $histClinico->fnacimiento }}</td>
            <td>{{ $histClinico->telf }}</td>
        </tr>
            @empty

        @endforelse --}}
    </tbody>
  </table>
</div>
@endsection 