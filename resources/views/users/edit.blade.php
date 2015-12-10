@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">

			@if (count($errors) > 0)
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					<strong>Whoops!</strong> There were some problems with your input.<br><br>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif


			@if(Session::has('error_message'))
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Error!</strong> {{ Session::get('error_message') }}
					</ul>
				</div>
			@endif


			<h1>Ls <small>edit account</small></h1>


			<!--<form role="form" method="POST" action="{{ url('/user/' . Auth::user()->id) }}">-->
			{!! Form::model($user, ['method' => 'PATCH', 'route' => ['user.update', $user->id]]) !!}

				<div class="form-group input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
					{!! Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Full name')) !!}
					<!--<input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Full name">-->
				</div>

				<div class="form-group input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
					{!! Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'Email')) !!}
				</div>

				<div class="form-group">
					<p>Input your password to confirm changes.</p>
				</div>

				<div class="form-group input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
					{!! Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) !!}
				</div>


				<div class="form-group">
					<button type="submit" class="btn btn-block btn-danger btn-lg">Save</button>
				</div>
			{!! Form::close() !!}


		</div>
	</div>
</div>
@stop