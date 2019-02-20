@extends('main_admin') 
@section('title', '| Admin - shareds') 
@section('content')
<button type="button" onclick="window.location='{{ route('shared.create') }}'" class="btn btn-primary"><i class="fa fa-plus"></i>  Create shared</button>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Shared Name</th>
      <th scope="col" colspan="2" class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($shareds as $shared)
    <tr>
      <td>{{ $shared->id }}</td>
      <td>{{ $shared->name }}</td>
      <td>
        <button onclick="window.location='{{ route('shared.edit', $shared->id) }}'" class="btn btn-primary pull-right"><i class="fa fa-pen"></i></button>
      </td>
      <td>
        <form action="{{ route('shared.destroy', $shared->id) }}" method="POST">
          {{ csrf_field() }} {{ method_field('DELETE') }}
          <button onclick="window.location='{{ route('shared.destroy', $shared->id) }}'" class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection