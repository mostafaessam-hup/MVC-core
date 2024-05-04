<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}" id="{{ __('admin.'.$name) }}_wrap">
    <label class="mb-1" for="{{ __('admin.'.$name) }}">{{ __('admin.'.$label) }}</label>
    <div class="form-check">
        <div class="radio">
            @foreach ($options as $key => $value)
                <input type="radio" id="{{ $key }}" class="form-check-input" checked=""
                    value="{{ $key }}">

                <label for="{{ $key }}">{{ $value }}</label>
            @endforeach
        </div>
        <span class="help-block"><strong id="{{$name}}_error">{{ $errors->first($name) }}</strong></span>
    </div>
</div>
