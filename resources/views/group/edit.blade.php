@extends('layout.app')

@section('content')

<div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
    @endif

    <form method="post" action="{{ route('groups.update', $groups->id) }}" class="form-group container mt-5 justify-content-md-center">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
                <div class="form-group">
                    <label for="name">Name : </label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $groups->name) }}"></input>
                </div>
                <div class="form-group">
                    <label for="description">Description : </label>
                    <textarea cols="5" rows="5" class="form-control" id="description" name="description">{{ old('description', $groups->name) }}</textarea>
                </div>
            <button type="submit" class="btn btn-primary pull-right">Update</button>
    </form>
</div>

@endsection