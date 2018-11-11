@extends('layouts.app', ['app_title' => 'Профиль'])

@section('content')

    <form action="{{ route('app.profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="form-group{{ $errors->has('name') ? ' is-invalid' : '' }}">
            <label for="name">Имя</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $user->name }}"
                   required>
            @if($errors->has('name'))
                <div class="mt-1 text-danger">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') ?? $user->email }}"
                   readonly>
        </div>

        @if ($user->avatar)
            <label for="avatar" class="form-group">
                <img src="{{ asset($user->avatar) }}" alt="">
            </label>
        @endif

        <div class="form-group">
            <label>Аватар</label>
            <input type="file" class="form-control" id="avatar" name="avatar">
        </div>

        <div class="mt-4">
            <button class="btn btn-primary">Обновить</button>
        </div>
    </form>

@endsection
