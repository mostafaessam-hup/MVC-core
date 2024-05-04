@extends('admin.layouts.partials.crud-components.create-page')

@section('form')
    {{ \App\Base\Helper\Field::text(name: 'name', label: 'name', required: 'false', placeholder: 'name') }}
    {{ \App\Base\Helper\Field::email(name: 'email', label: 'email', required: 'false', placeholder: 'email') }}
    {{ \App\Base\Helper\Field::number(name: 'phone', label: 'phone', required: 'false', placeholder: 'phone') }}
    {{ \App\Base\Helper\Field::password(name: 'password', label: 'password', required: 'false', placeholder: 'password') }}
    {{ \App\Base\Helper\Field::password(name: 'password_confirmation', label: 'password_confirmation', required: 'false', placeholder: 'password_confirmation') }}
    {{ \App\Base\Helper\Field::fileWithPreview(name: 'image', label: 'image', required: 'false') }}
@stop
