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
            <h1>User Lists</h1>
            <table class="table table-hover" >
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Username</th>
        <th scope="col">Email</th>
        <th scope="col" colspan="2" class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>      
      @foreach ($users as $user)
         <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->username }}</td>
          <td>{{ $user->email }}</td>
          <td>
            @if($user->active==1)
            <button onclick="window.location='{{ route('admin.activate', $user->id) }}'" class="btn btn-primary pull-right">Activate</button>
            @elseif($user->active==10)
            <button onclick="window.location='{{ route('admin.deactivate', $user->id) }}'" class="btn btn-primary pull-right">Deactivate</button>
            @endif
          </td>
          <td>
            {{-- <form action="{{ route('users.delete', $user->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
              <button onclick="window.location='{{ route('users.delete', $user->id) }}'" class="btn btn-danger">Delete</button>
            </form> --}}
            <button onclick="window.location='{{ route('admin.delete', $user->id) }}'" class="btn btn-danger">Delete</button>
          </td>
         </tr>
      @endforeach  
    </tbody>
  </table>
        </div>
    </div>
</div>
<br><br>
@include('partials._javascript')
@endsection