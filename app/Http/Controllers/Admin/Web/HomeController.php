<?php

namespace App\Http\Controllers\Admin\Web;

use App\Base\Controllers\Web\Controller;
use App\Models\Admin as Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct(FormRequest $request, Model $model)
    {
        parent::__construct(
            $request,
            $model,
            view_path: 'admin.home.',
        );
    }

    public function index()
    {
        $dataCounts = [
            // 'clients' => DB::table('clients')->count(),
            // 'orders' => DB::table('orders')->count(),
            // 'products' => DB::table('products')->count(),
            // 'services' => DB::table('services')->count(),
            // 'bookings' => DB::table('bookings')->count(),
        ];

        return view('admin.home.index', compact('dataCounts'));
    }
}
