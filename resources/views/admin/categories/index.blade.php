@extends('main_admin') 
@section('title', '| Admin - Category') 
@section('content')
<button type="button" onclick="window.location='{{ route('category.create') }}'" class="btn btn-primary"><i class="fa fa-plus"></i>  Create Category</button>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Category Name</th>
      <th scope="col" colspan="2" class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($categories as $category)
    <tr>
      <td>{{ $category->id }}</td>
      <td>{{ $category->name }}</td>
      <td>
        <button onclick="window.location='{{ route('category.edit', $category->id) }}'" class="btn btn-primary pull-right"><i class="fa fa-pen"></i></button>
      </td>
      <td>
        <form action="{{ route('category.destroy', $category->id) }}" method="POST">
          {{ csrf_field() }} {{ method_field('DELETE') }}
          <button onclick="window.location='{{ route('category.destroy', $category->id) }}'" class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection