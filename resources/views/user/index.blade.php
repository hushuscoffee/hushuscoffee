@extends('layout.app')

@section('content')

@if ($message = Session::get('success'))
  <div class="alert alert-success alert-block">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>	
    <strong>{{ $message }}</strong>
  </div>
@endif


<button type="button" onclick="window.location='{{ route('users.create') }}'" class="btn btn-primary mt-2"><i class="fa fa-plus"></i>  Create User</button>

<table class="table table-hover mt-5" >
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Username</th>
        <th scope="col">Password</th>
        <th scope="col" colspan="2" class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>      
      @foreach ($users as $user)
         <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->username }}</td>
          <td>{{ $user->password }}</td>
          <td>
            <button onclick="window.location='{{ route('users.edit', $user->id) }}'" class="btn btn-success pull-right"><i class="fa fa-pencil-square-o"></i></button>
          </td>
          <td>
            <form action="{{ route('users.delete', $user->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
              <button onclick="window.location='{{ route('users.delete', $user->id) }}'" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
            </form>
          </td>
         </tr>
      @endforeach  
    </tbody>
  </table>
@endsection

