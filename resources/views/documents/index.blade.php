@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-folder-open me-2"></i>Explorador de Documentos
                </h4>
                <form action="{{ route('documents') }}" method="GET" class="d-flex">
                    <input type="hidden" name="path" value="{{ $currentPath }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Buscar documentos..." value="{{ $search }}">
                        <button class="btn btn-light" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        @if($search)
                            <a href="{{ route('documents', ['path' => $currentPath]) }}" class="btn btn-light">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <!-- Breadcrumbs -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @foreach($breadcrumbs as $breadcrumb)
                        <li class="breadcrumb-item">
                            <a href="{{ route('documents', ['path' => $breadcrumb['path'], 'search' => $search]) }}">
                                {{ $breadcrumb['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ol>
            </nav>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($search && count($items) === 0)
                <div class="alert alert-info">
                    No se encontraron resultados para "{{ $search }}"
                </div>
            @endif

            <!-- Document List -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            @if($search)
                                <th>Carpeta</th>
                            @endif
                            <th>Tamaño</th>
                            <th>Última modificación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td>
                                    <i class="fas {{ $item['type'] === 'directory' ? 'fa-folder text-warning' : 'fa-file text-primary' }} me-2"></i>
                                    {{ $item['name'] }}
                                </td>
                                @if($search)
                                    <td>
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-folder me-1"></i>{{ $item['folder'] }}
                                        </span>
                                    </td>
                                @endif
                                <td>{{ $item['size'] }}</td>
                                <td>{{ $item['modified'] }}</td>
                                <td>
                                    @if($item['type'] === 'directory')
                                        <a href="{{ route('documents', ['path' => $item['path'], 'search' => $search]) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-folder-open"></i> Abrir
                                        </a>
                                    @else
                                        <a href="{{ asset('documentos/' . $item['path']) }}" class="btn btn-sm btn-success" target="_blank">
                                            <i class="fas fa-download"></i> Descargar
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $search ? '5' : '4' }}" class="text-center">No hay documentos en esta carpeta</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/documents.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/documents.js') }}"></script>
@endpush 