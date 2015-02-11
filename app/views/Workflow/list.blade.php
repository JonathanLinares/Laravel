@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('body')
	<div class="col-md-8">
		<h1 class="page-header">Tracking</h1>

		@include('workflow.filters')
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
				<tr>
					<th>Tipo de Documento</th>
					<th>Nombre</th>
					<th>Fecha Creacion</th>
					<th>Acciones</th>
				</tr>
				</thead>
				<tbody>
				@foreach($documents as $document)
					<tr>
						<td>{{$document->template->name}}</td>
						<td>{{$document->name}}</td>
						<td>{{$document->created_at}}</td>
						<td>
							<a href="{{Route('workflow.show',$document->id)}}" class="btn btn-info">
								Ver Tracking
							</a>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>

@endsection