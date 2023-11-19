<div>
    @if ($this->follows)
    <button wire:click="followToggle" type="button" class="btn btn-danger mt-2 @if ($this->sizeCss) w-100 @endif" style="width:150px;" style="z-index: 1;">
        Dejar de Seguir
    </button>
    @else
    <button wire:click="followToggle" type="button" class="btn btn-primary mt-2 @if ($this->sizeCss) w-100 @endif" style="width:150px;" style="z-index: 1;">
        Seguir
    </button>

    @endif
</div>
