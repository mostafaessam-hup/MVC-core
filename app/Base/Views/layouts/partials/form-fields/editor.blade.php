<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}" id="{{ __('admin.'.$name) }}_wrap">
    <label for="{{ __('admin.'.$name) }}">{{ __('admin.'.$label) }}</label>
    <div class="">
        {!! Form::textarea($name, $value, [
            'class' => 'form-control ' . $plugin,
            'id' => $name,
            'placeholder' => $label,
            'rows' => 10,
        ]) !!}
    </div>
    <span class="help-block"><strong id="{{$name}}_error">{{ $errors->first($name) }}</strong></span>
</div>
