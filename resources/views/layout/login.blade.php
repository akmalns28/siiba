<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @include('partials.css')

    <title>Login SIIBA</title>
</head>

<body>
    <section class="section">
        <div class="container mt-2">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand mb-4">
                        <img src="{{ asset('img/logo.png') }}" alt="logo" width="100"
                            class="shadow-light rounded-circle">
                    </div>

                    <div class="card card-primary mb-1">
                        <div class="card-header">
                            <div class="col-12 ">
                                <div class="row justify-content-center">
                                    <h3>SIIBA</h3>
                                </div>
                                <div class="row justify-content-center">
                                    <h4>Login</h4>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form method="post" action="{{ route('login-proses') }}" class="needs-validation"
                                novalidate="">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Username</label>
                                    <input id="email" type="text"
                                        class="form-control 
                                        @error('username')
                                            is-invalid
                                        @enderror"
                                        placeholder="Masukan Username" name="username" tabindex="1" required=""
                                        autofocus="" value="{{ old('username') }}">
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="">Password</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input type="password" name="password" id="password"
                                            placeholder="Masukan Password" value="{{ old('password') }}"
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
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="simple-footer mt-2 mb-auto">
                        Copyright © Akmal Nur Sidiq 2023
                    </div>
                </div>
            </div>
        </div>
    </section>
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

</body>

</html>
