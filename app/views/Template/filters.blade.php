{{ Form::open(['route' => 'template.index', 'method' => 'GET']) }}

    {{ Form::text('search') }}
    {{ Form::button('Buscar',['type' => 'submit', 'class' => 'btn btn-custom-search']) }}

{{Form::close()}}