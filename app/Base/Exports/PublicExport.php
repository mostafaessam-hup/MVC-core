<?php

namespace App\Base\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromCollection;

class PublicExport implements ShouldQueue, FromCollection
{
    use Exportable;

    public $resource;

    public function __construct($resource)
    {
        $this->resource = $resource;
    }

    public function collection()
    {
        return $this->resource;
    }
}
