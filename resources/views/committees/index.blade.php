@extends('layouts.app')

@section('content')
<div class="committees-section">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Comités</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <div class="card committees-card">
                    <div class="card-body">
                        <h1 class="h3 mb-4">Comités Institucionales</h1>
                        
                        <!-- Pestañas -->
                        <ul class="nav nav-tabs committees-tabs mb-4" id="committeesTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link-committee active" id="committees-tab" data-bs-toggle="tab" data-bs-target="#committees" type="button" role="tab">
                                    <i class="fas fa-users me-2"></i>Comités
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link-committee" id="meetings-tab" data-bs-toggle="tab" data-bs-target="#meetings" type="button" role="tab">
                                    <i class="fas fa-calendar-alt me-2"></i>Reuniones
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link-committee" id="upcoming-tab" data-bs-toggle="tab" data-bs-target="#upcoming" type="button" role="tab">
                                    <i class="fas fa-clock me-2"></i>Próximas Reuniones
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link-committee" id="tasks-tab" data-bs-toggle="tab" data-bs-target="#tasks" type="button" role="tab">
                                    <i class="fas fa-tasks me-2"></i>Tareas
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link-committee" id="task-followup-tab" data-bs-toggle="tab" data-bs-target="#task-followup" type="button" role="tab">
                                    <i class="fas fa-chart-line me-2"></i>Seguimiento Tareas
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link-committee" id="pending-signatures-tab" data-bs-toggle="tab" data-bs-target="#pending-signatures" type="button" role="tab">
                                    <i class="fas fa-file-signature me-2"></i>Firmas Pendientes
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link-committee" id="signature-tab" data-bs-toggle="tab" data-bs-target="#signature" type="button" role="tab">
                                    <i class="fas fa-signature me-2"></i>Firma
                                </button>
                            </li>
                        </ul>

                        <!-- Contenido de las pestañas -->
                        <div class="tab-content committees-tab-content" id="committeesTabsContent">
                            @include('committees.tabs.committees')
                            @include('committees.tabs.meetings')
                            @include('committees.tabs.upcoming-meetings')
                            @include('committees.tabs.tasks')
                            @include('committees.tabs.task-followup')
                            @include('committees.tabs.pending-signatures')
                            @include('committees.tabs.signature')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection






