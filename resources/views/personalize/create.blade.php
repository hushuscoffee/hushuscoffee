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

    <form method="post" action="{{ route('personalize.store') }}" class="form-group container mt-5 justify-content-md-center">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="title">Title : </label>
                <input type="text" class="form-control" id="title" name="title"></input>
            </div>
            <div class="form-group">
                <label for="description">Description : </label>
                <textarea rows="5" class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="sel1">Select Type:</label>
                <select class="form-control" id="sel1">
                    <option>Type 1</option>
                    <option>Type 2</option>
                    <option>Type 3</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Create</button>
    </form>
</div>

@endsection