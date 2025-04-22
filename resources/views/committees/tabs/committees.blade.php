<!-- Pestaña Comités -->
<div class="tab-pane fade show active" id="committees" role="tabpanel" aria-labelledby="committees-tab">
    <!-- Header con botón de crear -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="input-group input-group-lg" style="width: 400px;">
            <span class="input-group-text bg-white border-end-0">
                <i class="fas fa-search text-muted"></i>
            </span>
            <input type="text" id="committeeSearch" class="form-control border-start-0" placeholder="Buscar comités...">
        </div>
        @if(auth()->user()->role === 'admin')
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCommitteeModal">
                <i class="fas fa-plus me-2"></i> Crear Comité
            </button>
        @endif
    </div>

    <!-- Modal para crear comité -->
    <div class="modal fade" id="createCommitteeModal" tabindex="-1" aria-labelledby="createCommitteeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCommitteeModalLabel">Crear Comité</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('committees.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <input type="hidden" name="status" value="active">
                        <input type="hidden" name="slug" id="slug" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Crear Comité</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación para eliminar comité -->
    <div class="modal fade" id="deleteCommitteeModal" tabindex="-1" aria-labelledby="deleteCommitteeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCommitteeModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro de eliminar el comité <span id="committeeNameToDelete" class="fw-bold"></span>?</p>
                    <p class="text-danger"><small>Esta acción no se puede deshacer.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form id="deleteCommitteeForm" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Sí, Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4" id="committeesContainer">
        @foreach($committees as $committee)
            <div class="col-md-6 col-lg-4 committee-card" data-name="{{ strtolower($committee->name) }}" data-description="{{ strtolower($committee->description) }}">
                <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex align-items-start mb-3">
                            <div class="committee-icon me-3 flex-shrink-0">
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
                                <div class="icon-wrapper bg-light-primary rounded-circle p-3">
                                    <i class="fas {{ $icon }} fa-2x text-primary"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-1">{{ $committee->name }}</h5>
                                <p class="card-text text-muted small mb-0">{{ $committee->description }}</p>
                            </div>
                        </div>
                        <div class="mt-auto">
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('committees.show', $committee->id) }}" class="btn btn-sm btn-outline-primary me-2">
                                    <i class="fas fa-eye me-1"></i> Ver Detalles
                                </a>
                                @if(auth()->user()->role === 'admin')
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-danger delete-committee-btn" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteCommitteeModal"
                                            data-committee-id="{{ $committee->id }}"
                                            data-committee-name="{{ $committee->name }}"
                                            data-bs-whatever="{{ $committee->name }}">
                                        <i class="fas fa-trash me-1"></i> Borrar
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('styles')
<style>
    .hover-shadow {
        transition: all 0.3s ease;
    }
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    .icon-wrapper {
        transition: all 0.3s ease;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .card:hover .icon-wrapper {
        background-color: var(--bs-primary);
    }
    .card:hover .icon-wrapper i {
        color: white !important;
    }
    .input-group-lg .form-control,
    .input-group-lg .input-group-text {
        padding: 1rem;
    }
    .input-group:focus-within {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    .input-group:focus-within .input-group-text {
        border-color: #86b7fe;
    }
    .card {
        min-height: 200px;
    }
    .card-body {
        height: 100%;
    }
    .committee-icon {
        min-width: 60px;
    }
</style>
@endpush

@push('scripts')
<script>

</script>
@endpush





