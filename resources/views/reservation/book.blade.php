@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Бронирование зала</h1>

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
                <h5 class="card-title">{{ $room->name }}</h5>
                <p class="card-text"><strong>Описание:</strong> {{ $room->description }}</p>
                <p class="card-text"><strong>Вместительность:</strong> {{ $room->capacity }}</p>

                <form action="{{ route('reservation.rooms.book.store', $room->id) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="start_time">Начало бронирования</label>
                        <input type="datetime-local" name="start_time" id="start_time" class="form-control" value="{{ old('start_time') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="end_time">Конец бронирования</label>
                        <input type="datetime-local" name="end_time" id="end_time" class="form-control" value="{{ old('end_time') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Забронировать</button>

                </form>
            </div>
        </div>
    </div>
@endsection
