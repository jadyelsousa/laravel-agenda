@props(['status'])

@if ($status)
<div class="callout callout-success">
    <p>{{ $status }}</p>
</div>

@endif
