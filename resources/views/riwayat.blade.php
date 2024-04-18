@extends('layouts.app')

@section('title', 'Riwayat Pembayaran')
@section('content')

    <div class="container text-bg-dark">
        <div class="row mt-3">
            <div class="row mb-2">
                <div class="col-12 justify-content-center d-flex">
                    <h1>Riwayat</h1>
                </div>
                <hr>
            </div>
            <div class="col-6 my-2">
                <h3>Riwayat Transaksi</h3>
            </div>
            <div class="col-md-12 mb-4">
                <table class="table table-dark table-striped">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Lapangan</th>
                        <th>Tanggal</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                    @forelse ($bookings as $booking)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->court->court_type->name }} | {{ $booking->court->name }}</td>
                            <td>{{ $booking->date }}</td>
                            <td>{{ $booking->starttime }}</td>
                            <td>{{ $booking->endtime }}</td>
                            <td>Rp. {{ number_format($booking->total, 2, '.', '.') }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-warning">Lunas</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th scope="row" colspan="8" class="text-center">Belum ada Data</th>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>

@endsection
