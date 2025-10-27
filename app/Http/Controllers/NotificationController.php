<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotificationUser;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAsRead(Request $request)
    {
        $request->validate([
            'notification_ids' => 'required|array',
            'is_read' => 'required|boolean',
        ]);

        NotificationUser::whereIn('notification_id', $request->notification_ids)
            ->where('user_id', Auth::id())
            ->update(['is_read' => $request->is_read]);

    }

    public function markAsDeleted(Request $request)
    {
        $request->validate([
            'notification_ids' => 'required|array',
        ]);

        NotificationUser::whereIn('notification_id', $request->notification_ids)
            ->where('user_id', Auth::id())
            ->update(['is_deleted' => true]);

    }
}
