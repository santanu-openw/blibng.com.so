<?php

namespace Zix\Core\Http\Controllers;


use Illuminate\Http\Request;
use Zix\Core\Http\Resources\NotificationResource;

/**
 * Class NotificationController
 * @package Zix\Core\Http\Controllers
 * @resource User Notification
 */
class NotificationController
{
    /**
     * All
     * note: you can listen for upcoming notifications on channel ("notifications_{$user->id}")
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function all(Request $request)
    {
        return NotificationResource::collection($request->user()->notifications);
    }

    /**
     * Unread
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function unread(Request $request)
    {
        return NotificationResource::collection($request->user()->unreadNotifications);
    }

    /**
     * Mark All As Read
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function markAsRead(Request $request)
    {
        $user = $request->user();
        $user->unreadNotifications->markAsRead();
        return NotificationResource::collection($user->notifications);
    }
}