@extends($global['base']['namespace'] . 'admin.layouts.master')

@section('content')
    <div class="section-header">
        <h1>
            Edit Unit
            <a class="btn btn-success" href="{{ route($global['module']['routes']['index']) }}">
                Go To All Units
            </a>
        </h1>
    </div>

    <div class="section-body">
        <h2 class="section-title">Edit Unit</h2>
        <p class="section-lead">edit the unit</p>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>The Form</h4>
                    </div>
                    <div class="card-body">
                        @include($global['module']['path'] . '._form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
