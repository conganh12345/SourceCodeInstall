<!-- resources/views/welcome.blade.php -->

@extends('master')

@section('title', 'Home')

@section('content')
    <style>
        body {
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        h2 {
            color: yellow;
            background: white;
            padding: 10px;
        }
    </style>

    <div class="text-center">
        <h2>Võ Công Anh</h2>
    </div>
@endsection
