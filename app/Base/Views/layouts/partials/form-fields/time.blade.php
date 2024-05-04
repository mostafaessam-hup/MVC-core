<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}" id="{{ __('admin.'.$name) }}_wrap">
    <label for="{{ __('admin.'.$name) }}">{{ __('admin.'.$label) }}</label>
    <div class="">
        {!! Form::time($name, $value, [
            'placeholder' => $label,
            'class' => 'form-control',
            'id' => $name,
        ]) !!}
    </div>
    <span class="help-block"><strong id="{{$name}}_error">{{ $errors->first($name) }}</strong></span>
</div>
