@extends('layouts.app')


@section('content')

@include('auth.flats.flat-form', ["edit" => true])

@endsection
