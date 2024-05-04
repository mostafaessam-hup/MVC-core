<?php

namespace App\Http\Controllers\User\Api;

use App\Base\Traits\Response\SendResponse;
use App\Http\Requests\User\Api\NotificationRequest;
use App\Http\Resources\User\NotificationResource;

class NotificationController
{
    use SendResponse;

    public function index()
    {
        $record = auth()->guard('user-api')->user()->notifications->paginate(request()->per_page ?? 10);
        return $this->sendResponse(
            NotificationResource::collection($record),
            withmeta: true,
        );
    }

    public function show($id)
    {
        $record = auth()->guard('user-api')->user()->notifications()->findOrFail($id);
        return $this->sendResponse(NotificationResource::make($record));
    }

    public function destroy($id)
    {
        $model = auth()->guard('user-api')->user()->notifications()->findOrFail($id);
        $model->delete();
        return $this->SuccessMessage(__('user.successfully_deleted'));
    }
}
