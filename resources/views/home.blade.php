@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
{{--                <example-component></example-component>--}}
{{--                <test-component></test-component>--}}
                <fast-registration
                    class="btn btn-lg btn-info m-1"
                    :fast-login-create='@json(route('fastlogin.create'))'
                    :fast-login-create-details='@json(route('fastlogin.create.details'))'
                >
                    Подключить TouchID
                </fast-registration>
            </div>
        </div>
    </div>
</div>
@endsection
