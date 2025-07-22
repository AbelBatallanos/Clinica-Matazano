@extends("layouts.dashboar.panel")


@section("content")

<div class="table-responsive">
  <table class="table table-bordered table-hover align-middle text-center">
    <thead class="table-secondary">
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Email</th>
        <th>CI</th>
        <th>Fecha Nacimiento</th>
        <th>Teléfono</th>
      </tr>
    </thead>
    <tbody class="table-striped table-light">

        @forelse ($users as $user)
        <tr>    
            <td>{{ $user->id }}</td>
            <td>{{ $user->nameuser }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->lastname }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->ci }}</td>
            <td>{{ $user->fnacimiento }}</td>
            <td>{{ $user->telf }}</td>
            @empty

        </tr>
        @endforelse
    </tbody>
  </table>
</div>
@endsection