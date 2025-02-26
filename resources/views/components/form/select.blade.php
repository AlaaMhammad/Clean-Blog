@props(['label' => '', 'name' => '', 'placeholder' => '', 'oldval' => '', 'options' => []])

@if ($label)
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
@endif

<select class="form-select @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}">
    @if ($placeholder)
        <option value="" disabled selected>{{ $placeholder }}</option>
    @endif
    @foreach ($options as $option)
        <option value="{{ $option->id }}" @if ($option->id == old('category->id', $oldval)) selected @endif>{{ $option->name }}</option>
    @endforeach
</select>
@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
