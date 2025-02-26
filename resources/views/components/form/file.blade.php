@props(['label' => '', 'name' => '', 'oldimage' => ''])

@if ($label)
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
@endif

<input type="fil" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}">
@if ($oldimage)
    <img width="100" src="{{ asset($oldimage) }}" alt="{{ $oldimage }}" class="img-thumbnail mt-1 >
@endif
@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
