@extends('layouts.app')
@section('content')
    <redoc spec-url={{ asset('docs/docs.yaml') }}></redoc>
@endsection
