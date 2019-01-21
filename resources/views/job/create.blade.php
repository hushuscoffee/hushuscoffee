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

    <form method="post" action="{{ route('jobs.store') }}" class="form-group container mt-5 justify-content-md-center">
        {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name : </label>
                    <input type="text" class="form-control" id="name" name="name"></input>
                </div>
                <div class="form-group">
                    <label for="description">Description : </label>
                    <textarea cols="5" rows="5" class="form-control" id="description" name="description"></textarea>
                </div>
            <button type="submit" class="btn btn-primary pull-right">Create</button>
    </form>
</div>

@endsection