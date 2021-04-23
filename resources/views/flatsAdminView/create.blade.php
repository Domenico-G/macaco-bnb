@extends('layouts.app')

@section('title', 'Crea un nuovo appartamento')

@section('content')

@include('flatsAdminView.flat-form', ["create" => true])

@endsection
