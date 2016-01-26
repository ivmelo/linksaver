@extends('app')

@section('content')

	<div class="container">

		@if($errors->has())
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>There was a problem adding your link...</strong>
				<ul>
					@foreach($errors->all() as $message)
					<li>{{ $message }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		@if(Session::has('warning_message'))
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Hey joe!</strong> {{ Session::get('warning_message') }}
				</ul>
			</div>
		@endif


	    {!! Form::model($link, ['method' => 'PATCH', 'route' => ['link.update', $link->id]]) !!}
			<div class="form-group">
				{!! Form::text('title', null, array('class' => 'form-control', 'placeholder' => 'Leave blank to get title automatically or give it a custom title')) !!}
			</div>
			<div class="input-group">
				{!! Form::text('url', null, array('class' => 'form-control', 'placeholder' => 'Paste a url here to add it to your collection')) !!}
				<span class="input-group-btn">
					<button class="btn btn-default" type="submit">Save changes</button>
				</span>
			</div><!-- /input-group -->
		{!! Form::close() !!}


	</div>

@stop
