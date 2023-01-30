@extends('sales-management::layouts.app')

@section('content')

<div class="container-fluid p-0">

    <a href="#" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> New task</a>
    <h1 class="h3 mb-3">Tasks</h1>

    <div class="row">
        <table class="table table-bordered">
            <thead>
            <th>{{__("Task Name")}}</th>
            <th>{{__("Pipeline")}}</th>
            <th>{{__("Asignee")}}</th>
            </thead>

            <tbody>
            <tr>
                <td><a href="/task/primjer1">Nazvati sve autoskole i ponuditi partner program</a></td>
                <td>sales</td>
                <td>Tome Perica</td>
            </tr>
            <tr>
                <td><a href="/task/primjer2">Provjeriti imaju li partneri backlink</a></td>
                <td>backlink checker</td>
                <td>Nenad Ticaric</td>
            </tr>
            <tr></tr>
            </tbody>
        </table>
    </div>

</div>
@stop
