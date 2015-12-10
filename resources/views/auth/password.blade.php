@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
					
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif

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

					<h1>Linksaver <small>reset</small></h1>

					<form role="form" method="POST" action="{{ url('/password/email') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
								<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="your@email.com">
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-danger btn-block btn-lg">
								Send Password Reset Link
							</button>
						</div>
					</form>

		</div>
	</div>
</div>
@endsection
