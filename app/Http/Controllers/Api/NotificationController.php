<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        return response()->apiResponse(data:NotificationResource::collection($request->user()->notifications));
    }

    public function show(DatabaseNotification $notification)
    {
        if ($notification->read()) {
            return response()->apiResponse(message:"notification already read");
        }
        $notification->markAsRead();
        return response()->apiResponse(message:"notification read successfully",data:NotificationResource::make($notification));
    }
}
