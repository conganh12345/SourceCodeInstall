<!-- resources/views/welcome.blade.php -->
@extends('admin.layout.layout')

@section('title', 'Home')

@section('contents')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Home</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <style>
                body {
                    display: flex;
                    min-height: 100vh;
                    width: 100vw;
                    justify-content: center;
                    align-items: center;
                    margin: 0;
                }
                h2 {
                    color: yellow;
                    background: white;
                    padding: 10px;
                    margin-top: 120px;
                }
            </style>

            <div class="text-center">
                <h2>Võ Công Anh</h2>
            </div>
            @if(session('success'))
                <script>
                    alert("{{ session('success') }}");
                </script>
            @endif
        </div>
    </section>
@endsection

@section('head')
    @parent
    <meta name="viewport" content="width=device-width, initial-scale=1">
@endsection

@section('scripts')
    @parent
    <script>
        document.getElementById('home-link').addEventListener('click', function() {
            window.location.href = "{{ route('home') }}";
        });
    </script>
@endsection
