@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Усі зали</h1>

        <div class="row">
            @foreach ($rooms as $room)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $room->name }}</h5>
                            <p class="card-text"><strong>Опис:</strong> {{ $room->description }}</p>
                            <p class="card-text"><strong>Місткість:</strong> {{ $room->capacity }}</p>

                            @if (isset($userBookings[$room->id]))
                                <p class="card-text text-success">
                                    <strong>Ви забронювали цей зал з {{ $userBookings[$room->id]->start_time->format('d.m.Y H:i') }} по {{ $userBookings[$room->id]->end_time->format('d.m.Y H:i') }}</strong>
                                </p>
                                <form action="{{ route('reservation.rooms.cancel', $userBookings[$room->id]->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Відмінити бронювання</button>
                                </form>
                            @else
                                <a href="" class="btn btn-primary">Забронювати</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $rooms->links() }}
    </div>
@endsection
