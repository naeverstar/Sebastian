@extends('layouts.app')

@section('title', 'Booking')
@section('content')

    <div class="container">
        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session::get('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row ms-1 mb-3">
            <div class="col-6 text-start">
                <a href="{{ route('booking.index') }}" class="btn btn-outline-danger">Kembali</a>
            </div>
        </div>
        <div class="card text-bg-dark border-0">
            <div class="card-body">
                <form id="form-category" action="{{ route('booking.store') }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3 form-group">
                                <label for="basic-url" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Nama" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <label for="basic-url" class="form-label">Alamat</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    placeholder="Alamat" name="address" value="{{ old('address') }}" required>
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <label for="basic-url" class="form-label">Telepon</label>
                                <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="Nomor Telepon" name="phone" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <label for="basic-url" class="form-label">Lapangan</label>
                                <select name="court_id" class="form-select" id="court_id" required>
                                    <option value="" disabled selected>Open this select menu</option>
                                    @foreach ($courts as $court)
                                        <option value="{{ $court->id }}"
                                            {{ old('court_id') == $court->id ? 'selected' : null }}>
                                            {{ $court->name . ' | ' . $court->court_type->name . ' | Rp. ' . $court->price }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3 form-group">
                                <label for="basic-url" class="form-label">Tanggal</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror"
                                    placeholder="Tanggal" name="date" value="{{ old('date') }}" required>
                                @error('date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <label for="basic-url" class="form-label">Jam Mulai</label>
                                <input type="time" class="form-control @error('starttime') is-invalid @enderror"
                                    placeholder="Jam Mulai" name="starttime" value="{{ old('starttime') }}" required>
                                @error('starttime')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <label for="basic-url" class="form-label">Durasi</label>
                                <div class="input-group">
                                    <input type="number" class="form-control @error('duration') is-invalid @enderror"
                                        placeholder="Durasi" name="duration" value="{{ old('duration') }}" required
                                        min="1">
                                    <span class="input-group-text" id="basic-addon2">Jam</span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="45000" id="flexCheckDefault"
                                        name="costume">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Kostum (Rp. 45.000/jam)
                                    </label>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="50000" id="flexCheckDefault"
                                        name="shoes">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Sepatu (Rp. 50.000/jam)
                                    </label>
                                </div>
                            </div>
                            <div class="form-group ms-4 mb-3 text-end">
                                <input type="reset" value="Reset" class="btn btn-outline-danger">
                                <input type="submit" value="Simpan" class="btn btn-outline-warning">
                            </div>
                        </div>
                    </div>
                <form>
            </div>
        </div>
    </div>

@endsection
