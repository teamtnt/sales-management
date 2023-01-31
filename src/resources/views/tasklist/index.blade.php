@extends('sales-management::layouts.app')

@section('content')

    <div class="container-fluid p-0">

        <a href="{{ route('tasklist.create') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> New
            task</a>
        <h1 class="h3 mb-3">Tasks</h1>

        <div class="row">
            <table class="table table-bordered">
                <thead>
                <th>{{__("Task Name")}}</th>
                <th>{{__("Pipeline")}}</th>
                <th>{{__("Asignee")}}</th>
                </thead>

                <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td><a href="/task/primjer1">{{ $task->name }}</a></td>
                        <td>{{ $task->pipeline->name }}</td>
                        <td>Tome Perica</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@stop
