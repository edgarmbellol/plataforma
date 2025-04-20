@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">Hospital Marco Felipe Afanador</h1>
        <p class="hero-subtitle">Más de 50 años brindando atención médica de calidad en Tocaima</p>
    </div>
</section>

<!-- Mission and Vision Section -->
<section class="mission-vision section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card card-hover h-100">
                    <div class="card-body text-center p-4">
                        <div class="icon-box">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h3 class="card-title">Misión</h3>
                        <p class="card-text">Brindar atención médica de calidad, con calidez humana y compromiso social, contribuyendo al bienestar y desarrollo de la comunidad de Tocaima y sus alrededores.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card card-hover h-100">
                    <div class="card-body text-center p-4">
                        <div class="icon-box">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3 class="card-title">Visión</h3>
                        <p class="card-text">Ser reconocidos como el hospital líder en la región, destacándonos por nuestra excelencia en la atención médica, innovación tecnológica y compromiso con la comunidad.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="values-section section">
    <div class="container">
        <h2 class="text-center mb-5">Nuestros Valores</h2>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="value-card">
                    <i class="fas fa-heart value-icon"></i>
                    <h4>Compasión</h4>
                    <p>Brindamos atención con empatía y comprensión hacia nuestros pacientes.</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="value-card">
                    <i class="fas fa-handshake value-icon"></i>
                    <h4>Compromiso</h4>
                    <p>Nos dedicamos a brindar el mejor servicio con responsabilidad y ética.</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="value-card">
                    <i class="fas fa-users value-icon"></i>
                    <h4>Comunidad</h4>
                    <p>Trabajamos en conjunto para el bienestar de nuestra comunidad.</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="value-card">
                    <i class="fas fa-chart-line value-icon"></i>
                    <h4>Excelencia</h4>
                    <p>Buscamos la mejora continua en todos nuestros servicios.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="gallery-section section">
    <div class="container">
        <h2 class="text-center mb-5">Nuestras Instalaciones</h2>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="gallery-item">
                    <img src="{{ asset('banners/imagen 2.jpeg') }}" alt="Instalaciones del hospital">
                    <div class="overlay">
                        <i class="fas fa-search-plus"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="gallery-item">
                    <img src="{{ asset('banners/imagen 3.jpeg') }}" alt="Atención médica">
                    <div class="overlay">
                        <i class="fas fa-search-plus"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="gallery-item">
                    <img src="{{ asset('banners/imagen 4.jpeg') }}" alt="Equipo médico">
                    <div class="overlay">
                        <i class="fas fa-search-plus"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="gallery-item">
                    <img src="{{ asset('banners/imagen 1.jpeg') }}" alt="Hospital Marco Felipe Afanador">
                    <div class="overlay">
                        <i class="fas fa-search-plus"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
