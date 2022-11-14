@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('El link de verificación fué enviado a su correo electrónico') }}
                        </div>
                    @endif

                    {{ __('Antes de proceder, verifique su correo electrónico') }}
                    {{ __('No recibí el correo electrónico de verificación') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Click acá para volver a enviar el link') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
