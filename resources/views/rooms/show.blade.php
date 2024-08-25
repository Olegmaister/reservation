@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Деталі залу</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $room->name }}</h5>
                <p class="card-text"><strong>Опиc:</strong> {{ $room->description }}</p>
                <p class="card-text"><strong>Місткість:</strong> {{ $room->capacity }}</p>

                <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning">Редагувати</a>
                <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Назад до списку</a>
            </div>
        </div>
    </div>
@endsection
