<div>
    @if ($getState())
        <div class="flex gap-1">
            @foreach ($getState() as $record)
                <div>
                    <x-filament::badge color="gray">
                        {{ $record->name }}
                    </x-filament::badge>
                </div>
            @endforeach
        </div>
    @else
        <div>No Members</div>
    @endif
</div>
