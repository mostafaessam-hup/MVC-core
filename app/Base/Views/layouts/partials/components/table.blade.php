<section class="section">
    <div class="row" id="table-hover-row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="table-responsive py-1 px-3">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    @foreach ($columns as $key => $value)
                                        <th>{{ __('admin.' . $key) }}</th>
                                    @endforeach
                                    <th>{{ __('admin.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($records as $record)
                                    <tr id="removable{{ $record->id }}">
                                        @foreach ($columns as $k => $v)
                                            <td>{{ $record->$k }}</td>
                                        @endforeach
                                        <td>
                                            <a href="{{ route($edit_route, $record->id) }}">
                                                <button href class="btn btn-success float-start" type="button">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                            </a>
                                            <button id="{{ $record->id }}" data-token="{{ csrf_token() }}"
                                                data-route="{{ route($destroy_route, $record->id) }}" type="button"
                                                class="destroy btn btn-danger float-end">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-4">
                    {{ $records->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</section>
