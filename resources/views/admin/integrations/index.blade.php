@extends('admin.layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5><b>Google Search Console</b></h5>
                    </div>
                    <div class="card-body">
                        <form action="/admin/integrations/update" method="POST">
                            @method('put')
                            @csrf
                            <div class="mb-3">
                                <label for="google_verification">GSC Verification</label>
                                <input type="text" id="google_verification" name="google_verification"
                                    class="form-control" value="{{ env('GOOGLE_SEARCH_CONSOLE_VERIFICATION') }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5><b>Email Notifications</b></h5>
                    </div>
                    <div class="card-body">
                        <form action="/admin/integrations/update-email" method="POST">
                            @method('put')
                            @csrf
                            <div class="mb-3">
                                <label for="mail_mailer">MAIL MAILER</label>
                                <input type="text" id="mail_mailer" name="mail_mailer" class="form-control"
                                    value="{{ env('MAIL_MAILER') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="mail_host">MAIL HOST</label>
                                <input type="text" id="mail_host" name="mail_host" class="form-control"
                                    value="{{ env('MAIL_HOST') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="mail_port">MAIL PORT</label>
                                <input type="text" id="mail_port" name="mail_port" class="form-control"
                                    value="{{ env('MAIL_PORT') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="mail_username">MAIL USERNAME</label>
                                <input type="text" id="mail_username" name="mail_username" class="form-control"
                                    value="{{ env('MAIL_USERNAME') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="mail_password">MAIL PASSWORD</label>
                                <input type="text" id="mail_password" name="mail_password" class="form-control"
                                    value="{{ env('MAIL_PASSWORD') }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
