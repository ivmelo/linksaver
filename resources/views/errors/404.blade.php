@extends('app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="error-template text-center">
			        <h1>
			            Houston, we have a problem!</h1>
			        <h2>
			            404 Not Found</h2>
			        <div class="error-details">
			            <p>Sorry, an error has occured. The page was not found or you don't have access to it.</p>
			        </div>
			        <div class="error-actions">
			            <a href="{{ URL::to('/') }}" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-home"></span>
			                Take Me Home, Country Roads.</a>
			        </div>
			    </div>
			</div>
		</div>
	</div>
@stop