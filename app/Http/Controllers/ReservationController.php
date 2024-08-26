<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $rooms = Room::paginate(10);
        $userBookings = Booking::where('user_id', Auth::id())->get()->map(function ($booking) {
            $booking->start_time = Carbon::parse($booking->start_time);
            $booking->end_time = Carbon::parse($booking->end_time);
            return $booking;
        })->keyBy('room_id');

        return view('reservation.index', compact('rooms', 'userBookings'));
    }

    public function showBookingForm($id)
    {
        $room = Room::findOrFail($id);

        return view('reservation.book', compact('room'));
    }

    public function book(Request $request, $id)
    {
        $validated = $request->validate([
            'start_time' => 'required|date|after_or_equal:now',
            'end_time' => 'required|date|after:start_time',
        ]);

        $room = Room::findOrFail($id);

        $isAvailable = !Booking::where('room_id', $room->id)
            ->where(function ($query) use ($validated) {
                $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                    ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']])
                    ->orWhere(function ($query) use ($validated) {
                        $query->where('start_time', '<=', $validated['start_time'])
                            ->where('end_time', '>=', $validated['end_time']);
                    });
            })->exists();

        if (!$isAvailable) {
            return redirect()->back()->with('error', 'Ця зала вже заброньована на обраний час.');
        }

        Booking::create([
            'room_id' => $room->id,
            'user_id' => Auth::id(),
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
        ]);

        return redirect()->route('reservation.index')->with('success', 'Бронювання успішно виконано!');
    }

    public function cancel($id)
    {
        $booking = Booking::where('room_id', $id)
            ->where('user_id', Auth::id())
            ->first();

        $booking->delete();

        return redirect()->route('reservation.rooms.index')->with('success', 'Бронювання успішно скасовано.');
    }
}
