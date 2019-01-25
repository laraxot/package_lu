@extends('lu::layouts.app', ['title' => 'Verify'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang($view.'.Verify Your Email Address')</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            @lang($view.'.A fresh verification link has been sent to your email address')
                        </div>
                    @endif

                    @lang($view.'.Before proceeding, please check your email for a verification link')
                    @lang($view.'.If you did not receive the email'), <a href="{{ route('verification.resend') }}">@lang($view.'.click here to request another')</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
