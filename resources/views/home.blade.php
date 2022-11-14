@extends('layouts.app')

@section('content')
    @if(Auth::user()->rol == 'secretaria')
        re
    @endif
@endsection
