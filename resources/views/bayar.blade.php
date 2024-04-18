@extends('layouts.app')

@section('title', 'Pembayaran')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session::get('error') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="row mb-3">
                    <div class="col-6 text-start mt-4 ms-3">
                        <a href="{{ route('booking.index') }}" class="btn btn-outline-danger">Kembali</a>
                    </div>
                </div>
                <div class="card text-bg-dark border-0">
                    <div class="card-body">
                        <form action="{{ route('booking.update', $booking->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="basic-url" class="form-label">Total Sewa</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Total" name="total"
                                        value="{{ old('total', $booking->total) }}" id="total" required readonly>
                                </div>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="basic-url" class="form-label mb-0">Total Bayar</label>
                                <p class="text-secondary">
                                    (Pembayaran harus lebih dari atau sama dengan total sewa)
                                </p>
                                <input type="number" class="form-control @error('paytotal') is-invalid @enderror"
                                    placeholder="Total Bayar" name="paytotal" value="{{ old('paytotal') }}" id="paytotal"
                                    required>
                                @error('paytotal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="basic-url" class="form-label">Kembalian</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Kembali" name="kembalian"
                                        id="kembalian" readonly>
                                </div>
                            </div>
                            <div class="input-group justify-content-end d-flex mt-4 mb-3">
                                <input type="submit" value="Simpan" class="btn btn-outline-success">
                            </div>
                            <form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("paytotal").addEventListener('input', () => {
            let total = document.getElementById('total').value
            let bayar = document.getElementById('paytotal').value
            document.getElementById('kembalian').value = bayar - total
        })
    </script>

@endsection
