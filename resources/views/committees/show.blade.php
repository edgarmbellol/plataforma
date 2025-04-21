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
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 class="h3 mb-0">{{ $committee->name }}</h1>
                            <span class="badge bg-{{ $committee->status === 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($committee->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="lead">{{ $committee->description }}</p>
                        
                        <!-- Pestañas -->
                        <ul class="nav nav-tabs mb-4" id="committeeTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab">
                                    <i class="fas fa-info-circle me-2"></i>Resumen
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="members-tab" data-bs-toggle="tab" data-bs-target="#members" type="button" role="tab">
                                    <i class="fas fa-users me-2"></i>Miembros
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="meetings-tab" data-bs-toggle="tab" data-bs-target="#meetings" type="button" role="tab">
                                    <i class="fas fa-calendar-alt me-2"></i>Reuniones
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tasks-tab" data-bs-toggle="tab" data-bs-target="#tasks" type="button" role="tab">
                                    <i class="fas fa-tasks me-2"></i>Tareas
                                </button>
                            </li>
                        </ul>

                        <!-- Contenido de las pestañas -->
                        <div class="tab-content" id="committeeTabsContent">
                            <!-- Pestaña de Resumen -->
                            <div class="tab-pane fade show active" id="overview" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <h5 class="card-title">Información General</h5>
                                                <div class="committee-info">
                                                    <div class="d-flex justify-content-between mb-2">
                                                        <span class="text-muted">Miembros:</span>
                                                        <span class="fw-bold">{{ $committee->members()->count() }}</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between mb-2">
                                                        <span class="text-muted">Reuniones:</span>
                                                        <span class="fw-bold">{{ $committee->meetings()->count() }}</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between mb-2">
                                                        <span class="text-muted">Tareas Pendientes:</span>
                                                        <span class="fw-bold">{{ $committee->pendingTasks()->count() }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <h5 class="card-title">Próximas Reuniones</h5>
                                                <div class="upcoming-meetings">
                                                    @forelse($committee->upcomingMeetings()->take(3)->get() as $meeting)
                                                        <div class="meeting-item mb-2">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <span>{{ $meeting->title }}</span>
                                                                <small class="text-muted">{{ $meeting->start_date->format('d/m/Y H:i') }}</small>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <p class="text-muted">No hay reuniones programadas próximamente.</p>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pestaña de Miembros -->
                            <div class="tab-pane fade" id="members" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Rol</th>
                                                <th>Fecha de Ingreso</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($committee->members()->with('user')->get() as $member)
                                                <tr>
                                                    <td>{{ $member->user->name }}</td>
                                                    <td>
                                                        <span class="badge bg-{{ $member->role === 'president' ? 'primary' : ($member->role === 'secretary' ? 'info' : 'secondary') }}">
                                                            {{ ucfirst($member->role) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $member->joined_at->format('d/m/Y') }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-envelope"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Pestaña de Reuniones -->
                            <div class="tab-pane fade" id="meetings" role="tabpanel">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="mb-0">Historial de Reuniones</h5>
                                    <a href="{{ route('committees.meetings.index', $committee->slug) }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>Nueva Reunión
                                    </a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Título</th>
                                                <th>Fecha</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($committee->meetings()->orderBy('start_date', 'desc')->take(5)->get() as $meeting)
                                                <tr>
                                                    <td>{{ $meeting->title }}</td>
                                                    <td>{{ $meeting->start_date->format('d/m/Y H:i') }}</td>
                                                    <td>
                                                        <span class="badge bg-{{ $meeting->status === 'completed' ? 'success' : ($meeting->status === 'scheduled' ? 'primary' : 'warning') }}">
                                                            {{ ucfirst($meeting->status) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Pestaña de Tareas -->
                            <div class="tab-pane fade" id="tasks" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Tarea</th>
                                                <th>Asignado a</th>
                                                <th>Fecha Límite</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($committee->pendingTasks()->with(['meeting', 'assignedTo'])->get() as $task)
                                                <tr>
                                                    <td>{{ $task->description }}</td>
                                                    <td>{{ $task->assignedTo->name ?? 'No asignado' }}</td>
                                                    <td>{{ $task->due_date->format('d/m/Y') }}</td>
                                                    <td>
                                                        <span class="badge bg-warning">Pendiente</span>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
        background-color: #f8f9fa;
        min-height: 100vh;
        padding: 2rem 0;
    }

    .nav-tabs .nav-link {
        color: #6c757d;
        border: none;
        padding: 0.75rem 1.25rem;
        font-weight: 500;
    }

    .nav-tabs .nav-link:hover {
        color: #0143a3;
        border: none;
    }

    .nav-tabs .nav-link.active {
        color: #0143a3;
        border-bottom: 2px solid #0143a3;
        background: none;
    }

    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .card-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    }

    .table th {
        font-weight: 600;
        color: #495057;
    }

    .badge {
        font-weight: 500;
        padding: 0.5em 0.75em;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar las pestañas de Bootstrap
        const tabEl = document.querySelectorAll('button[data-bs-toggle="tab"]');
        tabEl.forEach(tab => {
            new bootstrap.Tab(tab);
        });
    });
</script>
@endpush 