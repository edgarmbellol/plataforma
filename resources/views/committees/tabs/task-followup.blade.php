<!-- Pestaña Seguimiento Tareas -->
<div class="tab-pane fade" id="task-followup" role="tabpanel">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Tarea</th>
                    <th>Comité</th>
                    <th>Asignado a</th>
                    <th>Fecha Límite</th>
                    <th>Progreso</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($committees as $committee)
                    @if(isset($committee->tasks) && $committee->tasks->isNotEmpty())
                        @foreach($committee->tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $committee->name }}</td>
                                <td>{{ $task->assigned_to->name ?? 'No asignado' }}</td>
                                <td>{{ $task->due_date->format('d/m/Y') }}</td>
                                <td>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-{{ $task->status === 'completed' ? 'success' : ($task->status === 'in_progress' ? 'primary' : 'warning') }}" 
                                             role="progressbar" 
                                             style="width: {{ $task->progress ?? 0 }}%;" 
                                             aria-valuenow="{{ $task->progress ?? 0 }}" 
                                             aria-valuemin="0" 
                                             aria-valuemax="100">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $task->status === 'completed' ? 'success' : ($task->status === 'in_progress' ? 'primary' : 'warning') }}">
                                        {{ ucfirst($task->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('committees.tasks.show', [$committee->slug, $task->id]) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div> 