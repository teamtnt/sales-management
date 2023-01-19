<h1>Showing all Contats</h1>

@forelse ($contacts as $contacts)
    <li>{{ $contact->firstname }}</li>
@empty
    <p> 'No contacts yet' </p>
@endforelse