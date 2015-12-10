@extends('app')

@section('content')

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Delete</h4>
	      </div>
	      <div class="modal-body">
	        Are you sure you want to delete this url from your collection?
	        (This action can't be undone)
	        <br />
	        <span class="glyphicon glyphicon-link"></span> <a href="{{ $link->url }}">{{ $link->url }}</a>
	      </div>
	      <div class="modal-footer">
	      	{!! Form::open(array('action' => array('LinkController@destroy', $link->id), 'method' => 'delete')) !!}
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	        
	        <button type="submit" class="btn btn-danger">Delete</button>
	        {!! Form::close() !!}
	      </div>
	    </div>
	  </div>
	</div>

		<!--<iframe frameborder="0" class="page-preview" src="{{ $link->url }}">Not supported.</iframe>-->
		<div class="container preview-options">

			<li class="list-group-item">
				<div class="row">
					<div class="col-md-8">
						<h3 class="list-group-item-heading">{{ $link->title }}<small> {{ $link->created_at->diffForHumans() }}</small></h3>
						<p class="list-group-item-text"><span class="glyphicon glyphicon-link"></span> {!! HTML::link($link->url, $link->url, ['title' => $link->title, 'target' => '_blank']) !!}</p>
					</div>
					<div class="col-md-2">
						<a class="btn btn-info btn-lg btn-block" href="{{ action('LinkController@edit', $link->id) }}"><span class="glyphicon glyphicon-edit"></span> Edit</a>
					</div>
					<div class="col-md-2">
						<button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#myModal">
			  			<span class="glyphicon glyphicon-remove"></span> Delete
						</button>
					</div>
				</div>
			</li>
			<br />
		</div>

		

		<object class="page-preview" type="text/html" data="{{ $link->url }}" style="width:100%;">

		<p>backup content</p>
		</object>
	
@stop

@section('style-specifics')
	<style type="text/css">
		html, body{
   			height: 100%;
   			min-height: 100%;
		}
		/*
		.navbar {
			margin-bottom: 0px;
		}*/
	</style>
@stop

@section('navbar-actions')
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <ul class="nav navbar-nav">
            <li>
                <p class="navbar-btn">
                    <a href="#" class="btn btn-default">Options!</a>
                </p>
            </li>
        </ul>
    </div>
</nav>
@stop