@extends('layout.app')

@section('content')

@if ($message = Session::get('success'))
  <div class="alert alert-success alert-block">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>	
    <strong>{{ $message }}</strong>
  </div>
@endif


<button type="button" onclick="window.location='{{ route('articles.create') }}'" class="btn btn-primary mt-2"><i class="fa fa-plus"></i>  Create Article</button>

<table class="table table-hover mt-5" >
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Description</th>
        <th scope="col">Comment Count</th>
        <th scope="col">UpVote</th>
        <th scope="col">DownVote</th>
        <th scope="col" colspan="2" class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>      
      @foreach ($articles as $article)
         <tr>
          <td>{{ $article->id }}</td>
          <td>{{ $article->description }}</td>
          <td>{{ $article->comment_count }}</td>
          <td>{{ $article->upvote_count }}</td>
          <td>{{ $article->downvote_count }}</td>
          <td>
            <button onclick="window.location='{{ route('articles.edit', $article->id) }}'" class="btn btn-success pull-right"><i class="fa fa-pencil-square-o"></i></button>
          </td>
          <td>
            <form action="{{ route('articles.delete', $article->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
              <button onclick="window.location='{{ route('articles.delete', $article->id) }}'" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
            </form>
          </td>
         </tr>
      @endforeach  
    </tbody>
  </table>
@endsection

