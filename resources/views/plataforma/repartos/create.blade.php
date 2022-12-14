@extends('layouts.plataforma')

@section('content')
    <form action=" {{ route('repartos.store') }}" method="post">
        @csrf

    </form>
@endsection
