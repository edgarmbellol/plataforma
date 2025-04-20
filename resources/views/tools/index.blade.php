@extends('layouts.app')

@section('content')
<div class="tools-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-5">
                <h1 class="display-4 fw-bold">Herramientas Institucionales</h1>
                <p class="lead">Accede a todas las herramientas y recursos disponibles para el personal del hospital</p>
            </div>
        </div>

        <div class="row g-4">
            @foreach($tools as $key => $tool)
                @if($tool['enabled'])
                    <div class="col-md-6 col-lg-4">
                        <div class="tool-card">
                            <div class="tool-icon">
                                @switch($key)
                                    @case('moodle')
                                        <i class="fas fa-graduation-cap"></i>
                                        @break
                                    @case('committees')
                                        <i class="fas fa-users"></i>
                                        @break
                                    @case('surveys')
                                        <i class="fas fa-poll"></i>
                                        @break
                                    @case('documents')
                                        <i class="fas fa-file-alt"></i>
                                        @break
                                    @case('calendar')
                                        <i class="fas fa-calendar-alt"></i>
                                        @break
                                    @case('news')
                                        <i class="fas fa-newspaper"></i>
                                        @break
                                @endswitch
                            </div>
                            <h3>{{ ucfirst($key) }}</h3>
                            <p>
                                @switch($key)
                                    @case('moodle')
                                        Plataforma de aprendizaje virtual para capacitaciones y cursos internos
                                        @break
                                    @case('committees')
                                        Gestión y seguimiento de comités institucionales
                                        @break
                                    @case('surveys')
                                        Sistema de encuestas y evaluaciones institucionales
                                        @break
                                    @case('documents')
                                        Repositorio de documentos y manuales institucionales
                                        @break
                                    @case('calendar')
                                        Calendario de eventos y actividades institucionales
                                        @break
                                    @case('news')
                                        Boletín de noticias y comunicados institucionales
                                        @break
                                @endswitch
                            </p>
                            <a href="{{ $tool['url'] }}" class="btn btn-primary tool-btn" @if($key === 'moodle') target="_blank" @endif>
                                @switch($key)
                                    @case('moodle')
                                        Acceder a Moodle
                                        @break
                                    @default
                                        Ver {{ ucfirst($key) }}
                                @endswitch
                                <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/tools.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/tools.js') }}"></script>
@endpush 