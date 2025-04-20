@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1>Bienvenido, {{ auth()->user()->name }}</h1>
                    <p>Has iniciado sesión correctamente en el sistema.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


