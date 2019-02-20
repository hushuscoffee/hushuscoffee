@extends('main_admin') 
@section('title', '| Admin - Status') 
@section('content')
<button type="button" onclick="window.location='{{ route('status.create') }}'" class="btn btn-primary"><i class="fa fa-plus"></i>  Create status</button>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Status Name</th>
      <th scope="col" colspan="2" class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($status as $stat)
    <tr>
      <td>{{ $stat->id }}</td>
      <td>{{ $stat->name }}</td>
      <td>
        <button onclick="window.location='{{ route('status.edit', $stat->id) }}'" class="btn btn-primary pull-right"><i class="fa fa-pen"></i></button>
      </td>
      <td>
        <form action="{{ route('status.destroy', $stat->id) }}" method="POST">
          {{ csrf_field() }} {{ method_field('DELETE') }}
          <button onclick="window.location='{{ route('status.destroy', $stat->id) }}'" class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection