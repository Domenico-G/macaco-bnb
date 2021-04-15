@extends('layouts.app')

@section('content')

@include('auth.flats.flat-form', ["create" => true])

@endsection
