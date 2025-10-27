<?php

namespace App\Http\Middleware;

use App\Models\Archive;
use App\Models\Folder;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;
use App\Models\Project;
use App\Models\Service;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Inspiring;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        [$message, $author] = str(Inspiring::quotes()->random())->explode('-');

        $shared = [
            ...parent::share($request),
            'name' => config('app.name'),
            'quote' => ['message' => trim($message), 'author' => trim($author)],
            'auth' => [
                'user' => $request->user(),
            ],
            'csrf_token' => csrf_token(),
            'ziggy' => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            'service_count'             => Service::count(),
            'member_count'              => User::whereNot('role', 'admin')->count(),
            'folder_count'              => Folder::count(),
            'file_count'                => Archive::count(),
            'project_count'             => Project::count(),
            'completed_project_count'   => Project::where('status', '=', 'completed')->count(),
            'task_count'                => Task::count(),
            'completed_task_count'      => Task::where('status', '=', 'completed')->count(),

            'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',
        ];

        if ($user = $request->user()) {
            $notifications = DB::table('notifications')
                ->join('notification_user', 'notifications.id', '=', 'notification_user.notification_id')
                ->where('notification_user.user_id', $user->id)
                ->where('notification_user.is_deleted', false)
                ->select(
                    'notifications.id',
                    'notifications.title',
                    'notifications.content',
                    'notifications.created_at',
                    'notification_user.is_read'
                )
                ->orderBy('notifications.created_at', 'desc')
                ->get();

            $shared['notifications'] = $notifications;
        } else {
            $shared['notifications'] = collect();
        }

        return $shared;
    }
}
