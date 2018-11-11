@extends('layouts.app')

@section('content')
    <h2>CREATING category</h2>

    @php
        $route = route('app.categories.store');
        $method = 'post';

        if (isset($news)) {
            $route = route('app.categories.update', $news);
            $method = 'patch';
        }
    @endphp

    <form action="{{ $route }}" method="post">
        @csrf
        @method($method)

        <div class="form-group{{ $errors->has('title') ? ' is-invalid' : '' }}">
            <label for="title">Категория</label>
            <input type="text" class="form-control" id="title" name="title" required>
            @if($errors->has('title'))
                <div class="mt-1 text-danger">
                    {{ $errors->first('title') }}
                </div>
            @endif
        </div>
        <div class="mt-4">
            <button class="btn btn-primary">Сохранить</button>
        </div>

    </form>
@endsection
