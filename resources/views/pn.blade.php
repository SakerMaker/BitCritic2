{{-- <nav>
    <div class="d-flex justify-content-center">
        <div wire:loading><img src="{{ url("img/loading.gif")}}" alt="" style="width:50px;" class="mb-4"></div>
    </div>
    <ul class="pagination justify-content-center">
        @if ($page=="NULL" || $page == 0)
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link fw-bold">Anterior</span>
            </li>
        @else
            <li class="page-item">
                <button class="page-link fw-bold" wire:click="previousPage" rel="prev">@lang('pagination.previous')</button>
            </li>
        @endif
        <li class="page-item">
            <button class="page-link fw-bold"  wire:click="nextPage" rel="next">@lang('pagination.next')</button>
        </li>
    </ul>
</nav> --}}

<nav>
    <div class="d-flex justify-content-center">
        <div wire:loading><img src="{{ url("img/loading.gif")}}" alt="" style="width:50px;" class="mb-4"></div>
    </div>
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <button class="page-link fw-bold"  wire:click="nextPage" rel="next">Cargar más...</button>
        </li>
    </ul>
</nav>