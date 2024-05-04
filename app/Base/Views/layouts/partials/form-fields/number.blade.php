<div class="form-group {{ $errors->has($name) ? 'is-invalid' : '' }}">
    <label class="mb-1" for="{{ __('admin.'.$name) }}">{{ __('admin.'.$label) }}</label>
    <input type="number" class="form-control" id="{{$name}}"  name={{$name}} placeholder="{{$label}}" spellcheck="false" data-ms-editor="true" {{$required == 'true' ? 'required' : ''}} value="{{ $value == null ? old($name) : $value }}">
    <span class="help-block"><strong id="{{$name}}_error">{{ $errors->first($name) }}</strong></span>

</div>