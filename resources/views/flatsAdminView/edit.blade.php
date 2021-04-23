@extends('layouts.app')

@section('title', 'Modifica il tuo appartamento')

@section('content')

@include('flatsAdminView.flat-form', ["edit" => true])

@endsection
