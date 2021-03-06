@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('body')
    <h1 class="page-header">Documento</h1>
<p>
    <a class="btn btn-custom-create" href="{{ Route('document.create') }}">Crear Documento</a>
</p>

    <h3>Se encontraron {{$documents->getTotal()}} Documentos.</h3>

    @include('document.filters')

    <table class="table .table-hover">
        <thead>
            <tr>
                <th>Serial</th>
                <th>Nombre</th>
                <th>Tipo Plantilla</th>
                <th>Fecha de Creacion</th>
                <th>Fecha de Ejecucion</th>
                <th width="30%">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($documents as $document)
            <tr>
                <td>{{$document->serial}}</td>
                <td class="name">{{$document->name}}</td>
                <td>{{$document->template->name}}</td>
                <td>{{$document->created_at}}</td>
                <td>{{$document->execute_date}}</td>

                <td>
                    {{ Form::open(['route' => ['document.destroy', $document->id ], 'method' => 'DELETE']) }}
                    @if($document->workflow->first()->users_id == \Sentry::getUser()->getId())
                        @if($document->workflow->count() > 1)
                            @if($document->workflow->find($document->workflow->first()->id+1)->users_id == 0)
                                <a class="btn btn-custom-edit" href="{{Route('document.edit', $document->id)}}">
                                    Editar
                                </a>
                            @endif
                        @else
                            <a class="btn btn-custom-edit" href="{{Route('document.edit', $document->id)}}">
                                Editar
                            </a>
                        @endif
                    @endif
                    <a class="btn btn-custom-show" href="{{Route('document.show', $document->id)}}">
                        Mostrar
                    </a>
                    <a href="{{Route('workflow.show',$document->id)}}" class="btn btn-custom-tracking">
                        Ver Tracking
                    </a>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
    {{$documents->links()}}
@endsection
