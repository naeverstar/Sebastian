<?php

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Transaction::where('paytotal', '=', 0)->get();
        return view('daftarbooking', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courts = Court::all();
        return view('booking', compact('courts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $court = Court::find($request->court_id);

        $message = [
            'required'  => ':attribute tidak boleh kosong',
            'min'       => ':attribute minimal: :min karakter',
            'after'     => ':attribute tidak boleh sebelum hari ini',
        ];

        $startTime = Carbon::parse($request->starttime)->format('H:i:s');
        $endTime = Carbon::parse($request->starttime)
            ->addHour($request->duration)
            ->format('H:i:s');

        $check = Transaction::where('court_id', $request->court_id)
            ->where('date', $request->date)
            ->where(function ($query) use ($startTime, $endTime) {
                //                                  this
                $query
                    ->where(function ($subQuery) use ($startTime, $endTime) {
                        $subQuery->whereTime('starttime', '>=', $startTime)
                            ->whereTime('starttime', '<', $endTime);
                    })
                    //                                  this
                    ->orwhere(function ($subQuery) use ($startTime, $endTime) {
                        $subQuery->whereTime('endtime', '<=', $endTime)
                            ->whereTime('endtime', '>', $startTime);
                    });
            })
            ->get();

        if ($check->count() > 0) {
            return back()->with('error', 'Jadwal tidak tersedia')->withInput($request->input());
        }

        $this->validate(
            $request,
            [
                'name' => 'required|min:3',
                'address' => 'required|min:15',
                'phone' => 'required|min:11',
                'date' => 'required|after:yesterday',
                'starttime' => 'required',
                'duration' => 'required|min:0',
            ],
            $message,
        );

        if ($request->costume != 45000) {
            $costume = 0;
        } else {
            $costume = 45000;
        }

        if ($request->shoes != 50000) {
            $shoes = 0;
        } else {
            $shoes = 50000;
        }

        $total = $request->duration * $court['price'] + $request->duration * ($costume + $shoes);

        $booking = Transaction::create([
            'user_id' => Auth::user()->id,
            'court_id' => $request->court_id,
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'date' => $request->date,
            'starttime' => $startTime,
            'endtime' => $endTime,
            'duration' => $request->duration,
            'costume' => $request->costume * $request->duration,
            'shoes' => $request->shoes * $request->duration,
            'total' => $total,
        ]);

        if ($booking) {
            return redirect(route('booking.index'))->with(['success' => 'Booking Berhasil Dilakukan!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    public function bayar($id)
    {
        $booking = Transaction::find($id);
        return view('bayar', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $message = [
            'required' => ':attribute harus diisi',
            'min' => ':attribute minimal :min karakter',
        ];

        $this->validate(
            $request,
            [
                'paytotal' => 'required',
            ],
            $message,
        );

        $bayar = Transaction::findOrFail($id);
        if ($bayar->total <= $request->paytotal) {
            $bayar->update([
                'paytotal' => $request->paytotal,
            ]);
        } else {
            //redirect dengan pesan error
            return redirect()->back()->with('error', 'Uang anda kurang');
        }

        if ($bayar) {
            //redirect dengan pesan sukses
            return redirect(route('booking.index'))->with(['success' => 'Pembayaran Berhasil']);
        }
    }

    public function riwayat()
    {
        $bookings = Transaction::where('paytotal', '!=', 0)->get();
        return view('riwayat', compact('bookings'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
