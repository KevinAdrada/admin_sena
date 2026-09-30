@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 800px;">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('home') }}#eventos" class="btn btn-outline-secondary btn-sm fw-bold shadow-sm" style="border-radius: 0.5rem;">
            <i class="bi bi-arrow-left me-1"></i> Volver al inicio
        </a>

        @auth
            <div class="d-flex gap-2">
                <a href="{{ route('event.edit', $event->id) }}" class="btn btn-outline-secondary shadow-sm d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; border-radius: 0.5rem;" title="Editar Evento">
                    <i class="bi bi-pencil-square fs-6"></i>
                </a>
                
                <form action="{{ route('event.destroy', $event->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este evento?');" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger shadow-sm d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; border-radius: 0.5rem;" title="Eliminar">
                        <i class="bi bi-trash3 fs-6"></i>
                    </button>
                </form>
            </div>
        @endauth
    </div>

    @php
        $eventDate = \Carbon\Carbon::parse($event->event_date)->startOfDay();
        $today = \Carbon\Carbon::now()->startOfDay();
        $isFinalized = $eventDate->lt($today);
        $statusValue = $isFinalized ? 'finalizado' : 'activo';
        $accentColor = $isFinalized ? '#6c757d' : '#00b646';
        $imageModel = $event->images->first();
        $imagenPath = $imageModel->imagen ?? $imageModel->url ?? $imageModel->path ?? null;
    @endphp

    <div class="card border-0 shadow-sm overflow-hidden" style="border-top: 4px solid {{ $accentColor }} !important; border-radius: 0.5rem;">
        
        <div class="position-relative" style="max-height: 400px; overflow: hidden;">
            @if (!empty($imagenPath))
                <img src="{{ asset('storage/images/' . $imagenPath) }}" class="w-100 object-fit-cover" style="height: 350px;" alt="{{ $event->title }}">
            @else
                <img src="{{ asset('images/default-event.png') }}" class="w-100 object-fit-cover" style="height: 350px;" alt="{{ $event->title }}">
            @endif
            
            @if ($isFinalized)
                <span class="position-absolute top-0 end-0 bg-secondary text-white fw-bold px-3 py-2 m-3 shadow-sm rounded-2"
                    style="font-size: 0.85rem;">
                    <i class="bi bi-check-circle-fill me-1"></i> FINALIZADO
                </span>
            @endif
        </div>

        <div class="card-body p-4 p-md-5 bg-light">
            
            <div class="d-flex align-items-center gap-3 mb-3 flex-wrap">
                <span class="badge text-white px-3 py-2 fw-semibold" style="background-color: {{ $accentColor }}; border-radius: 1rem;">
                    <i class="bi bi-calendar-event me-1"></i>
                    {{ $eventDate->format('d \d\e F \d\e Y') }}
                </span>
                <span class="text-muted small fw-semibold">
                    <i class="bi bi-clock me-1 text-success"></i> Hora: {{ $event->event_time }}
                </span>
                
                @if($event->trainingCenter)
                    <span class="text-muted small fw-semibold">
                        <i class="bi bi-building me-1 text-success"></i> Centro: {{ $event->trainingCenter->name }}
                    </span>
                @endif
            </div>

            <h1 class="fw-bold text-dark mb-4">{{ $event->title }}</h1>

            <div class="card border-0 shadow-sm p-3 mb-4">
                <div class="p-3 bg-light rounded border-start border-success border-4">
                    <span class="text-muted d-block text-uppercase fw-bold small mb-1">
                        <i class="bi bi-geo-alt-fill text-danger me-1"></i> Ubicación
                    </span>
                    <span class="text-dark fs-6">{!! nl2br(e($event->location)) !!}</span>
                </div>
            </div>

            <div class="card border-0 shadow-sm p-3 mb-4">
                <div class="p-3 bg-light rounded border-start border-success border-4">
                    <span class="text-muted d-block text-uppercase fw-bold small mb-2">
                        <i class="bi bi-info-circle-fill text-success me-1"></i> Acerca del evento
                    </span>
                    <div class="text-dark fs-6" style="line-height: 1.8; white-space: pre-line;">
                        {{ $event->description }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection