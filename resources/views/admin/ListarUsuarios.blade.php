
@forelse ($users as $user )
        <p> {{ $user }} </p>
@empty
    
@endforelse