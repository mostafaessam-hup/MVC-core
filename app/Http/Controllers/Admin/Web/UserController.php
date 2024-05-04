<?php

namespace App\Http\Controllers\Admin\Web;

use App\Base\Controllers\Web\Controller;
use App\Models\User as Model;
use App\Http\Requests\Admin\Web\UserRequest as FormRequest;

class UserController extends Controller
{
    public function __construct(FormRequest $request, Model $model)
    {
        parent::__construct(
            $request,
            $model,
            view_path: 'admin.users.',
        );
    }
}
