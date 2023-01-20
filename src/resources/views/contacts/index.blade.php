@extends('sales-management::layouts.app')

@section('content')
    <h1>Showing all Contats</h1>

    @forelse ($contacts as $contact)
        <li>{{ $contact }}</li>
    @empty
        <p> 'No contacts yet' </p>
    @endforelse
@stop
