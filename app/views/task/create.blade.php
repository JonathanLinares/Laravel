@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('body')

<h1 class="page-header">Crear Nuevo Tarea</h1>

{{ Form::open(['route' => 'task.store', 'method' => 'POST', 'role' => 'form']) }}

    <div class="form-group">
        {{Form::label('name','Nombre')}}
        {{Form::text('name')}}

        @if($errors->has())
            @foreach ($errors->all() as $error)
                <div class="error_message">{{ $error }}</div>
            @endforeach
        @endif

    </div>

<p>
    <input type="submit" value="Crear" class="btn btn-custom-create">
</p>

{{Form::close()}}

@endsection