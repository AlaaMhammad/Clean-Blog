@props(['label' => '', 'name' => '', 'placeholder' => '', 'oldval' => ''])

@if ($label)
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
@endif

<input type="text" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $oldval) }}" placeholder="{{ $placeholder }}">
@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
