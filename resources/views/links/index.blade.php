@extends('app')

@section('content')

	<div class="container">

		<!-- to display flash messages if present -->
		@if(Session::has('flash_message'))
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Voilà!</strong> {{ Session::get('flash_message') }}
			</div>
		@endif

		<!-- to display the create link form -->
		@include('links.partials.form')

		<br />

		<!--<h2>Your links</h2>-->
		<!--<hr />-->

		@if ($links->isEmpty())
			<h3><span class="lead">You haven't added any links yet. Add a link to your collection and it will be displayed here.</span></h3>
		@else

		<ul class="list-group">
			@foreach($links as $link)
			<li class="list-group-item">
				<div class="row">
					<div class="col-md-10">
						<h4 class="list-group-item-heading">{{ $link->title }}<small> {{ $link->created_at->diffForHumans() }}</small></h4>
						<p class="list-group-item-text"><span class="glyphicon glyphicon-link"></span> {!! HTML::link($link->url, $link->url, ['title' => $link->title, 'target' => '_blank']) !!}</p>
					</div>
					<div class="col-md-2">
						<a class="btn btn-default btn-lg btn-block" href="{{ action('LinkController@show', $link->id) }}"><span class="glyphicon glyphicon-share"></span> Display</a>
					</div>
				</div>
			</li>
			@endforeach
		</ul>

		@endif


		{!! $links->render() !!}
	</div>

@stop
