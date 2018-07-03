<div class="zoo-time text-right">
    <span>
        Current Zoo Time: {{ $currentZooTime->format('d-m-Y H:i') }}
        ({{ $currentZooTime->diffInHours($defaultZooTime) }} Hours played)
    </span>
</div>