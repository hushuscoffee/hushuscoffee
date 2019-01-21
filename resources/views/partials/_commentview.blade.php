        <div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h3 class="comments-title"><i class="fa fa-comments"></i>   {{ $article->comments()->count() }} @if($article->comments()->count()==0 || $article->comments()->count()==1) Comment @else Comments @endif</h3>
			@foreach($article->comments as $comment)
				<div class="comment">
					<div class="author-info">
						@if(($comment->user->photo == 'images/unknown.png') && ($comment->user->gender == 'Male'))
                                <img src=" {{ asset('/images/man.png') }}" class="author-image" alt="default-man">
                            @elseif(($comment->user->photo == 'images/unknown.png') && ($comment->user->gender == 'Female'))
                                <img src=" {{ asset('/images/woman.png') }}" class="author-image" alt="default-woman">
                            @else
                                <img src="{{ asset('image/avatar/'. $comment->user->photo) }}" class="author-image" alt="User Image">
                            @endif
						<div class="author-name">
                            <h4>{{$comment->user->fullname}} 
                            @if($comment->admin->id_role == 1)
                            <img src="{{asset('images/logo/hushus_coffee.png')}}" height="20px"/>
							@endif
							</h4>
							
							<p class="author-time">{{ date('F nS, Y - g:iA' ,strtotime($comment->created_at)) }}</p>
						</div>
					</div>

					<div class="comment-content">
						{{ $comment->text }}
						@if(Auth::check())
						@if($comment->id_user == Auth::user()->id)
						<form action="{{ route('comment.delete', $comment->id) }}" method="POST">
            					{{ csrf_field() }}
            					{{ method_field('DELETE') }}
              				<button onclick="window.location='{{ route('comment.delete', $comment->id) }}'" class="btn btn-info pull-right"><i class="fa fa-trash"></i></button>
							</form>
						@endif
						@endif
					</div>
					
				</div>
				<hr>
			@endforeach
		</div>
	</div>