@extends('layout.main')
@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $header }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('insert-user') }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-group">
                            <label class="M">Nama</label>
                            <input type="text" name="name" placeholder="Masukan Nama" value="{{ old('name') }}"
                                autofocus
                                class="form-control 
                            @error('name')
                                is-invalid
                            @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="M">Username</label>
                            <input type="text" name="username" placeholder="Masukan Username"
                                value="{{ old('username') }}"
                                class="form-control 
                            @error('username')
                                is-invalid
                            @enderror">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="M">Password</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" name="password" id="password" placeholder="Masukan Password"
                                    value="{{ old('password') }}"
                                    class="form-control 
                            @error('password')
                                is-invalid
                            @enderror">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" id="toggleBtn"
                                        onclick="togglePasswordVisibility()">Show</button>
                                </div>
                            </div>
                            <small id="passwordHelpBlock" class="form-text text-muted">
                                Your password must be 8-20 characters long,
                            </small>
                        </div>
                        <div class="form-group">
                            <label class="M">Hak Akses</label>
                            <select
                                class="form-control 
                            @error('hak_akses_id')
                                is-invalid
                            @enderror"
                                name="hak_akses_id">
                                <option disabled value="">--Pilih Hak Akses--</option>
                                @foreach ($hak_akses as $index => $hk)
                                    <option value="{{ $hk->id }}">{{ $hk->hak_akses }}</option>
                                @endforeach
                            </select>
                            @error('hak_akses_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="d-flex flex-row ">
                            <div class="col-sm-12 col-md-6">
                                <a href="{{ route('kategori') }}" class="btn btn-primary btn-block">Batal</a>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <button type="submit" class="btn btn-primary btn-block">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('password');
            var toggleBtn = document.getElementById('toggleBtn');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleBtn.textContent = 'Hide';
            } else {
                passwordInput.type = 'password';
                toggleBtn.textContent = 'Show';
            }
        }
    </script>
@endpush
