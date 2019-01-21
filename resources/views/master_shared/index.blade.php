@extends('main')
@section('title',' Admin-Dashboard')
@section('stylesheets')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
@include('partials._nav')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('partials._leftbar')
        </div>
        <div class="col-md-9">
<br><br>
<button type="button" onclick="window.location='{{ route('shared.create') }}'" class="btn btn-primary"><i class="fa fa-plus"></i>  Create Master Shared</button>

<table class="table table-hover" >
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col" colspan="2" class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>      
      @foreach ($shared as $share)
         <tr>
          <td>{{ $share->id }}</td>
          <td>{{ $share->name }}</td>
          <td>
            <button onclick="window.location='{{ route('shared.edit', $share->id) }}'" class="btn btn-primary pull-right"><i class="fa fa-pencil-square-o"></i></button>
          </td>
          <td>
            <form action="{{ route('shared.delete', $share->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
              <button onclick="window.location='{{ route('shared.delete', $share->id) }}'" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
            </form>
          </td>
         </tr>
      @endforeach  
    </tbody>
  </table>
        </div>
</div>
</div>
<br>
@include('partials._javascript')
@endsection

