@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('head')
    {{ HTML::script('ckeditor/ckeditor.js') }}
@endsection

@section('body')
    {{ Form::open(['route' => ['stepsSave'], 'method' => 'POST', 'role' => 'form']) }}

    <h1 class="page-header">Asignacion de Pasos para: {{$template->name}}</h1>

    <div class="form-group">
        {{ Form::hidden('templates_id',$template->id) }}
    </div>

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Pasos Actuales</div>

        <!-- Table -->
        <table class="table">
            <tr>
                <th>Paso</th>
                <th>Grupo Responsable</th>
                <th>N° Orden</th>
            </tr>
            @foreach($stepDocuments as $stepDocument)
                <tr>
                    <td>{{$stepDocument->task->name}}</td>
                    <td>{{$stepDocument->group->name}}</td>
                    <td>{{$stepDocument->order}}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <table class="table .table-hover text-center">
        <thead>
        <tr>
            <th width="20%" class="text-center">Paso</th>
            <th width="40%" class="text-center">Grupo Responsable</th>
            <th width="10%" class="text-center">N° Orden</th>
        </tr>
        </thead>
        <tbody>
            @foreach($steps as $step)
            <tr>
                <td>{{Form::label('tasks_id',$step->name),Form::hidden('tasks_id[]',$step->id)}}</td>
                <td>
                    {{Field::select('groups_id[]',$groups)}}
                </td>
                <td>
                    {{Field::select('order[]',$totalSteps)}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p>
        <a href="{{Route('template.index')}}" class="btn btn-danger">Atras</a>
        <input type="submit" value="Asignar" class="btn btn-success">
    </p>
    {{Form::close()}}

@endsection