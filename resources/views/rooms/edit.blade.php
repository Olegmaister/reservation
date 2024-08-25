@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Редагування залу</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('rooms.update', $room->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Назва</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $room->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Опис</label>
                        <textarea name="description" id="description" class="form-control">{{ old('description', $room->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="capacity">Місткість</label>
                        <input type="number" name="capacity" id="capacity" class="form-control" value="{{ old('capacity', $room->capacity) }}" min="1" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Оновити зал</button>
                </form>
            </div>
        </div>
    </div>
@endsection
