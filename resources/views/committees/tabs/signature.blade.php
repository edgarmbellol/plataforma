<!-- Pestaña Firma -->
<div class="tab-pane fade" id="signature" role="tabpanel">
    <div class="row g-4">
        @foreach($committees as $committee)
            @if(isset($committee->documents) && $committee->documents->isNotEmpty())
                @foreach($committee->documents->where('status', 'pending_signature') as $document)
                    <div class="col-md-6 col-lg-4">
                        <div class="committee-card">
                            <div class="card-icon">
                                <i class="fas fa-signature"></i>
                            </div>
                            <h3 class="card-title">{{ $document->title }}</h3>
                            <div class="meeting-info">
                                <p class="mb-2">
                                    <i class="fas fa-users me-2 text-primary"></i>
                                    {{ $committee->name }}
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-calendar-day me-2 text-primary"></i>
                                    Fecha: {{ $document->created_at->format('d/m/Y') }}
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-user me-2 text-primary"></i>
                                    Creado por: {{ $document->created_by->name ?? 'Desconocido' }}
                                </p>
                                <p class="mb-2">
                                    <span class="badge bg-warning">
                                        Pendiente de firma
                                    </span>
                                </p>
                            </div>
                            <div class="card-actions">
                                <a href="{{ route('committees.documents.sign', [$committee->slug, $document->id]) }}" class="btn-details">
                                    Firmar documento
                                    <i class="fas fa-signature ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        @endforeach
    </div>
</div> 