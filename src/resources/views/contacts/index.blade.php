<h1>Showing all Contats</h1>

@forelse ($contacts as $contact)
    <li>{{ $contact }}</li>
@empty
    <p> 'No contacts yet' </p>
@endforelse
