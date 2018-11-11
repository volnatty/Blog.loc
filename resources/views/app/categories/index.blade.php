@extends('layouts.app')

@section('content')

    @forelse ($category as $category)
        <h2>
            <a href="{{ route('app.categories.show', ['category'=>$category]) }}">
                {{ $category->title }}
            </a>
        </h2>
    @empty
        <div class="col">
            @auth
                <h3>Нет у вас категорий</h3>
                <a href="{{ route('app.categories.create') }}"
                   class="btn btn-primary">
                    ADD
                </a>

            @endauth
        </div>
    @endforelse
    @auth
        <a href="{{route('app.categories.create')}}">
            <class class="btn btn-primary">
                Добавить еще категорию?
            </class>
        </a>
    @endauth

@endsection
