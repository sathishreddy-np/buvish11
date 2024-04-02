<div style="display: flex; align-items: center;">
    <img src="{{ asset($image) }}" alt="{{ $name }}" style="height: 2rem;">
    <span style="margin-left: 5px;"><strong>{{ \Illuminate\Support\Str::words($name, 2, '') }}</strong></span>
</div>
