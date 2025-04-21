<!-- Pestaña Reuniones -->
<div class="tab-pane fade" id="meetings" role="tabpanel">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Comité</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Lugar</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($committees as $committee)
                    @if(isset($committee->meetings) && $committee->meetings->isNotEmpty())
                        @foreach($committee->meetings as $meeting)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-users me-2 text-primary"></i>
                                        {{ $committee->name }}
                                    </div>
                                </td>
                                <td>{{ $meeting->date->format('d/m/Y') }}</td>
                                <td>{{ $meeting->time }}</td>
                                <td>{{ $meeting->location }}</td>
                                <td>
                                    <span class="badge bg-{{ $meeting->status === 'completed' ? 'success' : ($meeting->status === 'scheduled' ? 'primary' : 'warning') }}">
                                        {{ ucfirst($meeting->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('committees.meetings.show', [$committee->slug, $meeting->id]) }}" class="btn btn-sm btn-outline-primary">
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