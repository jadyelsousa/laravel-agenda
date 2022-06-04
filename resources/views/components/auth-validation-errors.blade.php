@props(['errors'])

@if ($errors->any())
    <div class="callout callout-danger">
        @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
