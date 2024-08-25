@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Список залів</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('rooms.create') }}" class="btn btn-primary mb-3">Додати зал</a>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Назва</th>
                        <th>Опи</th>
                        <th>Місткість</th>
                        <th>Дії</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($rooms as $room)
                        <tr>
                            <td>{{ $room->id }}</td>
                            <td>{{ $room->name }}</td>
                            <td>{{ $room->description }}</td>
                            <td>{{ $room->capacity }}</td>
                            <td>
                                <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-info btn-sm">Перегляд</a>
                                <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning btn-sm">Редагувати</a>
                                <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Видалити</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Немає доступних залів</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            {{ $rooms->links() }}
        </div>
    </div>
@endsection
