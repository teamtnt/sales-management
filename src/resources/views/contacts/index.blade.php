@extends('sales-management::layouts.app')

@section('title', 'Sales')

@section('content')
    <h1>Showing all Contats</h1>

    @forelse ($contacts as $contact)
        <li>{{ $contact }}</li>
    @empty
        <p> 'No contacts yet' </p>
    @endforelse

    <div class="my-4">
        <hello-world />
    </div>
@stop
