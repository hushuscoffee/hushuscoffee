@extends('main_admin') 
@section('title', '| Admin - Roles') 
@section('content')
<button type="button" onclick="window.location='{{ route('role.create') }}'" class="btn btn-primary"><i class="fa fa-plus"></i>  Create Role</button>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Role Name</th>
      <th scope="col" colspan="2" class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($roles as $role)
    <tr>
      <td>{{ $role->id }}</td>
      <td>{{ $role->name }}</td>
      <td>
        <button onclick="window.location='{{ route('role.edit', $role->id) }}'" class="btn btn-primary pull-right"><i class="fa fa-pen"></i></button>
      </td>
      <td>
        <form action="{{ route('role.destroy', $role->id) }}" method="POST">
          {{ csrf_field() }} {{ method_field('DELETE') }}
          <button onclick="window.location='{{ route('role.destroy', $role->id) }}'" class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection