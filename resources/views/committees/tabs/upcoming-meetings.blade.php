<!-- Pestaña Próximas Reuniones -->
<div class="tab-pane fade" id="upcoming" role="tabpanel">
    <div class="row g-4">
        @foreach($committees as $committee)
            @if(isset($committee->meetings) && $committee->meetings->isNotEmpty())
                @foreach($committee->meetings->where('status', 'scheduled')->sortBy('date') as $meeting)
                    <div class="col-md-6 col-lg-4">
                        <div class="committee-card">
                            <div class="card-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <h3 class="card-title">{{ $committee->name }}</h3>
                            <div class="meeting-info">
                                <p class="mb-2">
                                    <i class="fas fa-calendar-day me-2 text-primary"></i>
                                    {{ $meeting->date->format('d/m/Y') }}
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-clock me-2 text-primary"></i>
                                    {{ $meeting->time }}
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                    {{ $meeting->location }}
                                </p>
                            </div>
                            <div class="card-actions">
                                <a href="{{ route('committees.meetings.show', [$committee->slug, $meeting->id]) }}" class="btn-details">
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