<!-- Pestaña Tareas -->
<div class="tab-pane fade" id="tasks" role="tabpanel">
    <div class="row g-4">
        @foreach($committees as $committee)
            @if(isset($committee->tasks) && $committee->tasks->isNotEmpty())
                @foreach($committee->tasks as $task)
                    <div class="col-md-6 col-lg-4">
                        <div class="committee-card">
                            <div class="card-icon">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <h3 class="card-title">{{ $task->title }}</h3>
                            <div class="meeting-info">
                                <p class="mb-2">
                                    <i class="fas fa-users me-2 text-primary"></i>
                                    {{ $committee->name }}
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-calendar-day me-2 text-primary"></i>
                                    Fecha límite: {{ $task->due_date->format('d/m/Y') }}
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-user me-2 text-primary"></i>
                                    Asignado a: {{ $task->assigned_to->name ?? 'No asignado' }}
                                </p>
                                <p class="mb-2">
                                    <span class="badge bg-{{ $task->status === 'completed' ? 'success' : ($task->status === 'in_progress' ? 'primary' : 'warning') }}">
                                        {{ ucfirst($task->status) }}
                                    </span>
                                </p>
                            </div>
                            <div class="card-actions">
                                <a href="{{ route('committees.tasks.show', [$committee->slug, $task->id]) }}" class="btn-details">
                                    Ver detalles
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        @endforeach
    </div>
</div> 