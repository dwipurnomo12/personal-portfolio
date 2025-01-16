@extends('layouts.app')

@section('content')
    <div class="card mb-0">
        <div class="card-body">
            <div class="my-4">
                <h4 class="text-center">Login</h4>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" class="form-control" name="email" aria-describedby="emailHelp"
                        required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" class="form-control" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fs-4 mb-4">Login</button>
            </form>
        </div>

    </div>
@endsection
