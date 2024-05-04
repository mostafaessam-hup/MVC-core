<section class="section">
    <div class="row" id="table-hover-row">
        <div class="col-12">
            <div class="card p-3">
                {{-- <div class="card-header">
                    <h4 class="card-title">Hoverable rows</h4>
                </div> --}}
                <div class="card-content">
                    <form class="form" method="POST" action="{{ route($update_route, $record->id) }}">
                        @csrf
                        @method('PUT')
                        @foreach ($fields as $field => $options)
                            @if ($options['input-type'] == 'text')
                                {{ \App\Base\Helper\Field::text($field, __('admin.' . $field), $record->$field) }}
                            @elseif ($options['input-type'] == 'email')
                                {{ \App\Base\Helper\Field::email($field, __('admin.' . $field), $record->$field) }}
                            @elseif ($options['input-type'] == 'number')
                                {{ \App\Base\Helper\Field::number($field, __('admin.' . $field), $record->$field) }}
                            @elseif ($options['input-type'] == 'password')
                                {{ \App\Base\Helper\Field::password($field, __('admin.' . $field), $record->$field) }}
                            @elseif ($options['input-type'] == 'select')
                                {{ \App\Base\Helper\Field::select($field, __('admin.' . $field), $record->$field) }}
                            @elseif ($options['input-type'] == 'checkBox')
                                {{ \App\Base\Helper\Field::checkBox($field, __('admin.' . $field), $record->$field) }}
                            @elseif ($options['input-type'] == 'radio')
                                {{ \App\Base\Helper\Field::radio($field, __('admin.' . $field), $record->$field) }}
                            @elseif ($options['input-type'] == 'textarea')
                                {{ \App\Base\Helper\Field::textarea($field, __('admin.' . $field), $record->$field) }}
                            @elseif ($options['input-type'] == 'fileWithPreview')
                                {{ \App\Base\Helper\Field::fileWithPreview($field, __('admin.' . $field), $record->$field) }}
                            @elseif ($options['input-type'] == 'multiFileUpload')
                                {{ \App\Base\Helper\Field::multiFileUpload($field, __('admin.' . $field), $record->$field) }}
                            @elseif ($options['input-type'] == 'dateTime')
                                {{ \App\Base\Helper\Field::dateTime($field, __('admin.' . $field), $record->$field) }}
                            @elseif ($options['input-type'] == 'dateRange')
                                {{ \App\Base\Helper\Field::dateRange($field, __('admin.' . $field), $record->$field) }}
                            @endif
                        @endforeach
                        <br />
                        <div class="col-12 d-flex justify-content-start">
                            <button type="submit"
                                class="btn btn-primary me-1 mb-1">{{ __('admin.submit') }}</button>
                            <button type="reset"
                                class="btn btn-light-secondary me-1 mb-1">{{ __('admin.reset') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
