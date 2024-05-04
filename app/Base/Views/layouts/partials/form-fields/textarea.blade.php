<div class="form-group mb-3">
    <label class="mb-1" for="{{ __('admin.'.$name) }}">{{ __('admin.'.$label) }}</label>
    <textarea class="form-control" id="{{ __('admin.'.$name) }}" rows="3" spellcheck="false" data-ms-editor="true"
        style="height: 71px;" placeholder="{{ __('admin.'.$label) }}" value="{{ $value == null ? old($name) : $value }}"></textarea>
        <span class="help-block"><strong id="{{$name}}_error">{{ $errors->first($name) }}</strong></span>
    </div>
