@extends('admin.layouts.partials.crud-components.edit-page')

@section('form')
    {{ \App\Base\Helper\Field::text(name: 'name', label: 'name', required: 'false', placeholder: 'name', value: $record->name) }}
    {{ \App\Base\Helper\Field::email(name: 'email', label: 'email', required: 'false', placeholder: 'email', value: $record->email) }}
    {{ \App\Base\Helper\Field::number(name: 'phone', label: 'phone', required: 'false', placeholder: 'phone', value: $record->phone) }}
    {{ \App\Base\Helper\Field::fileWithPreview(name: 'image', label: 'image', required: 'false', path: $record->image_url) }}
@stop
