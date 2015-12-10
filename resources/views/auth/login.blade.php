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

			<h1>Linksaver <small>alpha</small></h1>

			<form role="form" method="POST" action="{{ url('/auth/login') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<div class="form-group input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
					<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
				</div>

				<div class="form-group input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
					<input type="password" class="form-control" name="password" placeholder="Password">

				</div>

				<div class="form-group">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="remember"> Remember Me
						</label>
					</div>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-danger btn-block btn-lg">Login</button>
				</div>
				
				<div class="form-group">
					<a href="{{ url('/password/email') }}">Forgot Your Password?</a>
				</div>
				
			</form>



		</div>
	</div>
</div>
@endsection
