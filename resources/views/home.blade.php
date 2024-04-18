@extends('layouts.app')

@section('title', 'Home')
@section('content')

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8 col-lg-8 mb-3">
                <div class="card">
                    <div class="card-header text-bg-dark font-bold">Daftar Lapangan</div>

                    <div class="card-body text-bg-light">
                        <div class="row">

                            <!-- Loop -->
                            @foreach ($courts as $court)
                                <div class="col-4 mb-3">
                                    <div class="card border-dark px-3 py-3">
                                        <h5 class="card-title">{{ $court->court_type->name }}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $court->name }}</h6>
                                        <p class="card-text">
                                            <td>Rp. {{ number_format($court->price, 2, '.', '.') }} / Jam</td>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                            <!-- /Loop -->

                            <div class="col-6 mb-2">
                                <div class="card border-dark px-3 py-3">
                                    <h5 class="card-title">Sepatu</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Sewa</h6>
                                    <p class="card-text">Rp. 50.000 / Jam</p>
                                </div>
                            </div>

                            <div class="col-6 mb-2">
                                <div class="card border-dark px-3 py-3">
                                    <h5 class="card-title">Kostum</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Sewa</h6>
                                    <p class="card-text">Rp. 45.000 / Jam</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div> --}}
            </div>

            <div class="col-md-4 col-lg-4 mb-3">
                <div class="card">
                    <div class="card-header text-bg-dark">Tata Cara</div>

                    <div class="card-body text-bg-light" style="margin-bottom: 70px">
                        <p>1. Klik Halaman Booking</p>
                        <p>2. Cek Jadwal pada Halaman Daftar Booking</p>
                        <p>3. Jika ingin menyewa, tekan tombol 'Booking'</p>
                        <p>4. Masukkan data</p>
                        <p>5. Jika berhasil, anda akan dialihkan ke halaman Daftar Booking, kemudian tekan tombol 'Bayar'
                        </p>
                        <p>6. Isi pembayaran sesuai nominal</p>
                        <p>7. Jika berhasil, anda dapat mengecek riwayat pendaftaran</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
