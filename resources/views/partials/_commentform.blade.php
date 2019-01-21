        <div class="row">
		<div id="comment-form" class="col-md-8 col-md-offset-2">
			{{ Form::open(['route' => ['comment.store', $article->id], 'method' => 'POST']) }}
				
				<div class="row">
					<div class="col-md-12">
						{{ Form::label('comment', "Comment:") }}
						{{ Form::textarea('text', null, ['class' => 'form-control', 'rows' => '5']) }}
						@if(Auth::check())
						{{ Form::submit('Add Comment', ['class' => 'btn btn-primary pull-left', 'style' => 'margin-top:15px;']) }}
						@else
						<button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#myModal" style="margin-top:15px">Add Comment</button>
						@endif
					</div>
				</div>

			{{ Form::close() }}
		</div>
	</div>
	<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
	  
		  <!-- Modal content-->
		  <div class="modal-content">
				<div class="text-center">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
			  <label>You are not logged in yet.</label><br>
			  <label>Please login <a href="{{route ('login')}}" class="btn btn-primary">here</a></label>
			</div>
			{{-- <div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div> --}}
		  </div>
		  </div>
	  
		</div>
	  </div>
	  
	
	