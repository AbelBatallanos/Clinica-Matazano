@extends("layouts.dashboar")

@section('content')
    
    <form>
        @csrf
        <section>

            <section>
                <h3>Nombre: </h3>
                <section>
                    <input type="text" value="TuNombre"/>
                </section>
            </section>

            <section>
                <label>
                    Apellidos
                </label>
                <section>
                    <input type="text" value="TuApellido"/>
                </section>
            </section>

        </section>
    
    </form>

    <form method="post" action="">
        @csrf
        <input value="Eliminar Cuenta" type="submit" />
    </form>

@endsection

