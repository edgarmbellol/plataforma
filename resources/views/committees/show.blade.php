@extends('layouts.app')

@section('content')
<div class="committee-details-section">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('committees.index') }}">Comités</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $committee->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h1 class="card-title h2 mb-4">{{ $committee->name }}</h1>
                        <p class="lead">{{ $committee->description }}</p>
                        
                        <div class="mt-4">
                            <h5 class="mb-3">Acciones Rápidas</h5>
                            <div class="d-flex gap-2">
                                <a href="{{ route('committees.meetings.index', $committee->slug) }}" class="btn btn-primary">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    Ver Reuniones
                                </a>
                                <a href="{{ route('committees.members.index', $committee->slug) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-users me-2"></i>
                                    Ver Miembros
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Próximas Reuniones</h5>
                        <div class="upcoming-meetings">
                            <!-- Aquí se mostrarán las próximas reuniones -->
                            <p class="text-muted">No hay reuniones programadas próximamente.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Información del Comité</h5>
                        <div class="committee-info">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Estado:</span>
                                <span class="badge bg-success">{{ $committee->status }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Miembros:</span>
                                <span class="fw-bold">{{ $committee->members()->count() }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Reuniones:</span>
                                <span class="fw-bold">{{ $committee->meetings()->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Miembros Principales</h5>
                        <div class="committee-members">
                            @forelse($committee->members()->with('user')->take(5)->get() as $member)
                                <div class="d-flex align-items-center mb-3">
                                    <div class="member-avatar me-3">
                                        <i class="fas fa-user-circle fa-2x text-secondary"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $member->user->name }}</h6>
                                        <small class="text-muted">{{ $member->role }}</small>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">No hay miembros registrados.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .committee-details-section {
        padding: 3rem 0;
        background-color: #f8f9fa;
        min-height: 100vh;
    }

    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .member-avatar {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .badge {
        padding: 0.5em 1em;
        font-weight: 500;
    }

    .breadcrumb {
        background: transparent;
        padding: 0;
    }

    .breadcrumb-item a {
        color: #6c757d;
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        color: #0d6efd;
    }

    .btn {
        padding: 0.5rem 1rem;
        border-radius: 8px;
    }

    .btn-outline-primary:hover {
        background-color: #f8f9fa;
        color: #0d6efd;
        border-color: #0d6efd;
    }
</style>
@endpush 