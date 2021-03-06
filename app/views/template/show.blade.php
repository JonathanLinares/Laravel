@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('head')
    {{ HTML::script('ckeditor/ckeditor.js') }}
@endsection

@section('body')
    {{ Form::model($template,['route' => ['template.index'], 'method' => 'GET', 'role' => 'form']) }}

    <h1 class="page-header">Informacion de la Plantilla: {{$template->name}}</h1>

    <div class="form-group text-center">
    <br>
    <div class="col-lg-12">
        {{$template->body}}
        <br>
        <br>
    </div>
    <p>
        <input type="submit" value="Atras" class="btn btn-custom-back">
    </p>
    </div>

    {{Form::close()}}

@endsection
