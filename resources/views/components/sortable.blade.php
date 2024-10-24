@props(['column', 'sortColumn' , 'sortDirection'])

<div class="flex cursor-pointer gap-x-2 group" wire:click="sortBy('{{ $column }}')">
    <p> 
        {{ $slot }}
    </p>
    @if($sortColumn == $column)
        @if($sortDirection == 'asc')
            <x-icons.arrow-long-up />
        @else
            <x-icons.arrow-long-down />

        @endif
    @else
    <div class="opacity-0 group-hover:opacity-100">
        <x-icons.arrow-up-down />
    </div>
    @endif
</div>