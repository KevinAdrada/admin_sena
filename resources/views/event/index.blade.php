<div class="container mb-5 eventos" style="padding-bottom: 100px;" id="eventos">
    <div class="container mb-4 d-flex justify-content-between align-items-center px-0 flex-wrap gap-3">
        <h2 class="fw-bold text-dark mb-0 position-relative pb-2">
            Eventos Institucionales
        </h2>

        <div class="d-flex align-items-center gap-3 flex-wrap ms-auto">
            <div class="dropdown">
                <button
                    class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center gap-2 px-3 shadow-sm bg-white"
                    type="button" id="filterDropdownMenu" data-bs-toggle="dropdown" aria-expanded="false"
                    data-bs-auto-close="outside">
                    <i class="bi bi-funnel-fill text-secondary"></i>
                    <span>Filtrar</span>
                </button>

                <div class="dropdown-menu p-3 shadow border-0 rounded-3 mt-2" style="width: 280px;"
                    aria-labelledby="filterDropdownMenu">
                    <span class="text-muted small fw-bold d-mb-1">Estado:</span>
                    <div class="d-flex flex-column gap-2 mb-3">
                        <div class="form-check">
                            <input class="form-check-input filter-checkbox" type="checkbox" value="all"
                                id="checkAll" checked>
                            <label class="form-check-label text-dark small fw-semibold" for="checkAll">Todos</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input filter-checkbox" type="checkbox" value="activo"
                                id="checkActivo">
                            <label class="form-check-label text-dark small" for="checkActivo">Próximos / Activos</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input filter-checkbox" type="checkbox" value="finalizado"
                                id="checkFinalizado">
                            <label class="form-check-label text-dark small" for="checkFinalizado">Finalizados</label>
                        </div>
                    </div>

                    <hr class="my-2 text-muted">

                    <span class="text-muted small fw-bold d-block mb-2">Fecha del Evento:</span>
                    <div class="mb-3">
                        <div class="row g-2">
                            <div class="col-6">
                                <label class="form-label text-muted" style="font-size: 0.75rem;">Desde</label>
                                <input type="date" id="filterDateFrom" class="form-control form-control-sm">
                            </div>
                            <div class="col-6">
                                <label class="form-label text-muted" style="font-size: 0.75rem;">Hasta</label>
                                <input type="date" id="filterDateTo" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                        <button type="button"
                            class="btn btn-link btn-sm text-decoration-none text-info p-0 fw-semibold"
                            id="clearFiltersBtn">Limpiar</button>
                        <button type="button" class="btn btn-sm text-white px-3 fw-semibold"
                            style="background-color: #009688;" id="applyFiltersBtn">Filtrar</button>
                    </div>
                </div>
            </div>

            @auth
                @if (in_array(auth()->user()->rol, ['admin', 'instructor']))
                    <a href="{{ route('event.create') }}" class="btn text-white fw-bold shadow-sm"
                        style="background-color: #00b646;">
                        <i class="bi bi-plus-circle me-1"></i> Crear Evento
                    </a>
                @endif
            @endauth
        </div>
    </div>

    <div class="d-flex flex-nowrap overflow-x-auto pb-4 custom-scroll"
        style="gap: 1.5rem; scroll-snap-type: x mandatory;">
        @foreach ($events->sortBy('event_date') as $event)
            @php
                $eventDate = \Carbon\Carbon::parse($event->event_date)->startOfDay();
                $today = \Carbon\Carbon::now()->startOfDay();

                $isFinalized = $eventDate->lt($today);
                $statusValue = $isFinalized ? 'finalizado' : 'activo';
                $accentColor = $isFinalized ? '#6c757d' : '#00b646';

                $imageModel = $event->images->first();
                $imagenPath = $imageModel->imagen ?? null;
            @endphp

            <div class="event-card-item" data-status="{{ $statusValue }}" data-date="{{ $eventDate->format('Y-m-d') }}"
                style="flex: 0 0 calc(28% - 1rem); min-width: 270px; scroll-snap-align: start;">
                <div class="card h-100 border-0 shadow-sm card-event position-relative overflow-hidden"
                    style="border-top: 4px solid {{ $accentColor }} !important;">

                    @if ($isFinalized)
                        <span class="position-absolute top-0 end-0 bg-secondary text-white fw-bold px-3 py-1 shadow-sm"
                            style="font-size: 0.75rem; border-bottom-left-radius: 8px; z-index: 2;">
                            <i class="bi bi-check-circle-fill me-1"></i> FINALIZADO
                        </span>
                    @endif

                    <div class="position-relative overflow-hidden" style="height: 180px;">
                        @if (!empty($imagenPath))
                            <img src="{{ asset('storage/images/' . $imagenPath) }}"
                                class="card-img-top w-100 h-100 object-fit-cover" alt="{{ $event->title }}">
                        @else
                            <img src="{{ asset('images/default-event.png') }}"
                                class="card-img-top w-100 h-100 object-fit-cover" alt="{{ $event->title }}">
                        @endif
                    </div>

                    <div class="card-body p-4 d-flex flex-column {{ $isFinalized ? 'opacity-75' : '' }}">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="badge text-white px-3 py-2 fw-semibold"
                                style="background-color: {{ $accentColor }};">
                                <i class="bi bi-calendar-event me-1"></i>
                                {{ $eventDate->format('d M Y') }}
                            </span>
                            <small class="text-muted"><i class="bi bi-clock me-1"></i> {{ $event->event_time }}</small>
                        </div>

                        <h3 class="h5 fw-bold text-dark mb-2">{{ $event->title }}</h3>

                        <div class="border-top pt-3 mt-3 d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="bi bi-geo-alt me-1"></i> {!! nl2br(e($event->location)) !!}
                            </small>

                            @if ($isFinalized)
                                <a href="{{ route('event.show', $event->id) }}" class="btn btn-sm fw-bold px-3"
                                    style="color: #6c757d; border: 1px solid #6c757d;"
                                    onmouseover="this.style.backgroundColor='#6c757d'; this.style.color='#fff';"
                                    onmouseout="this.style.backgroundColor='transparent'; this.style.color='#6c757d';">
                                    Ver Resumen
                                </a>
                            @else
                                <a href="{{ route('event.show', $event->id) }}" class="btn btn-sm fw-bold px-3"
                                    style="color: #00b646; border: 1px solid #00b646;"
                                    onmouseover="this.style.backgroundColor='#00b646'; this.style.color='#fff';"
                                    onmouseout="this.style.backgroundColor='transparent'; this.style.color='#00b646';">
                                    Detalles
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    .custom-scroll::-webkit-scrollbar {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
    }

    .custom-scroll {
        scrollbar-width: none !important;
        -ms-overflow-style: none !important;
        overflow-x: auto !important;
    }

    .card-event {
        border-top: 4px solid #00b646 !important;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card-event:hover {
        transform: translateY(-4px);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1) !important;
    }

    .eventos {
        scroll-margin-top: 100px;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const applyBtn = document.getElementById("applyFiltersBtn");
        const clearBtn = document.getElementById("clearFiltersBtn");
        const checkboxes = document.querySelectorAll(".filter-checkbox");
        const checkAll = document.getElementById("checkAll");
        const dateFromInput = document.getElementById("filterDateFrom");
        const dateToInput = document.getElementById("filterDateTo");
        const eventCards = document.querySelectorAll(".event-card-item");

        applyBtn.addEventListener("click", function() {
            let selectedStatuses = [];
            if (checkAll.checked) {
                selectedStatuses.push("all");
            } else {
                checkboxes.forEach(cb => {
                    if (cb.value !== "all" && cb.checked) {
                        selectedStatuses.push(cb.value);
                    }
                });
            }

            const dateFrom = dateFromInput.value ? new Date(dateFromInput.value) : null;
            const dateTo = dateToInput.value ? new Date(dateToInput.value) : null;
            if (dateTo) dateTo.setHours(23, 59, 59, 999);

            eventCards.forEach(card => {
                const cardStatus = card.getAttribute("data-status");
                const cardDateStr = card.getAttribute("data-date");
                const cardDate = new Date(cardDateStr + "T00:00:00");

                let matchesStatus = selectedStatuses.includes("all") || selectedStatuses
                    .includes(cardStatus);
                let matchesDate = true;

                if (dateFrom && cardDate < dateFrom) matchesDate = false;
                if (dateTo && cardDate > dateTo) matchesDate = false;

                if (matchesStatus && matchesDate) {
                    card.style.display = "";
                } else {
                    card.style.display = "none";
                }
            });

            let dropdownEl = document.getElementById('filterDropdownMenu');
            let dropdown = bootstrap.Dropdown.getInstance(dropdownEl);
            if (dropdown) dropdown.hide();
        });

        clearBtn.addEventListener("click", function() {
            checkAll.checked = true;
            checkboxes.forEach(cb => {
                if (cb.value !== "all") cb.checked = false;
            });
            dateFromInput.value = "";
            dateToInput.value = "";
            eventCards.forEach(card => card.style.display = "");
        });

        checkAll.addEventListener("change", function() {
            if (this.checked) {
                checkboxes.forEach(cb => {
                    if (cb.value !== "all") cb.checked = false;
                });
            }
        });

        checkboxes.forEach(cb => {
            if (cb.value !== "all") {
                cb.addEventListener("change", function() {
                    if (this.checked) checkAll.checked = false;
                });
            }
        });
    });
</script>
