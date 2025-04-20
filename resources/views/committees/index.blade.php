@extends('layouts.app')

@section('content')
<div class="committees-section">
    <!-- Hero Section -->
    <div class="hero-section mb-5">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold text-white mb-3 animate__animated animate__fadeInUp">
                        Comités Institucionales
                    </h1>
                    <p class="lead text-white-75 mb-4 animate__animated animate__fadeInUp animate__delay-1s">
                        Gestión y seguimiento de los comités del hospital para garantizar la excelencia en nuestros servicios
                    </p>
                    <div class="stats-row animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="stat-item">
                            <div class="stat-value">{{ $committees->count() }}</div>
                            <div class="stat-label">Comités Activos</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">24/7</div>
                            <div class="stat-label">Disponibilidad</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">100%</div>
                            <div class="stat-label">Compromiso</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Committees Grid -->
    <div class="container">
        <div class="row g-4">
            @foreach($committees as $committee)
            <div class="col-md-6 col-lg-4">
                <div class="committee-card">
                    <div class="card-icon">
                        @php
                            $icons = [
                                'etica-medica' => 'fa-heart',
                                'gagas' => 'fa-leaf',
                                'atencion-integral-victimas-violencia-sexual' => 'fa-hands-holding',
                                'humanizacion' => 'fa-users',
                                'historias-clinicas' => 'fa-folder',
                                'hospitalario-emergencias' => 'fa-hospital',
                                'copasst' => 'fa-shield-alt',
                                'calidad' => 'fa-award',
                                'vigilancia-epidemiologica' => 'fa-chart-line',
                                'estadisticas-vitales' => 'fa-chart-bar',
                                'seguridad-paciente' => 'fa-user-shield',
                                'iaas' => 'fa-microscope',
                                'iamii' => 'fa-child',
                                'rias' => 'fa-road',
                                'farmacia-terapeutica' => 'fa-capsules'
                            ];
                            $icon = $icons[$committee->slug] ?? 'fa-users';
                        @endphp
                        <i class="fas {{ $icon }}"></i>
                    </div>
                    <h3 class="card-title">{{ $committee->name }}</h3>
                    <p class="card-description">{{ $committee->description }}</p>
                    <div class="card-actions">
                        <a href="{{ route('committees.show', $committee->slug) }}" class="btn-details">
                            Ver detalles
                            <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                        <div class="quick-actions">
                            <a href="{{ route('committees.meetings.index', $committee->slug) }}" class="btn-action" title="Ver reuniones">
                                <i class="fas fa-calendar-alt"></i>
                            </a>
                            <a href="{{ route('committees.members.index', $committee->slug) }}" class="btn-action" title="Ver miembros">
                                <i class="fas fa-users"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<link rel="stylesheet" href="{{ asset('css/committees.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/committees.js') }}"></script>
@endpush
