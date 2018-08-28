<?php

namespace Zix\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Zix\Core\Http\Requests\User\ChangePasswordRequest;
use Zix\Core\Http\Requests\User\ProfileUpdateRequest;
use Zix\Core\Http\Requests\User\UpdateAvatarRequest;
use Zix\Core\Http\Resources\UserResource;

/**
 * Class UserController
 * @package Zix\Core\Http\Controllers
 * @resource User
 */
class UserController extends Controller
{
    /**
     * My Data
     * @param Request $request
     * @return UserResource
     */
    public function me(Request $request)
    {
        return new UserResource($request->user());
    }
    /**
     * Update Password
     *
     * @param ChangePasswordRequest $request
     * @return UserResource
     */
    public function updatePassword(ChangePasswordRequest $request)
    {
        $user = $request->user();
        $user->password = bcrypt($request->get('password'));
        $user->save();
        return new UserResource($user);
    }

    /**
     * Update Avatar
     * @param UpdateAvatarRequest $request
     * @return UserResource
     */
    public function updateAvatar(UpdateAvatarRequest $request)
    {
        $user = $request->user();

        $user->getMedia('images')->map(function ($image) {
            $image->delete();
        });

        $media = $user->addMediaFromBase64($request->get('avatar'))
            ->usingFileName('avatar.png')
            ->toMediaCollection('images')->getUrl();
        $user->avatar = url($media);
        $user->save();

        return new UserResource($user);
    }

    /**
     * @param ProfileUpdateRequest $request
     * @return UserResource
     */
    public function updateProfile(ProfileUpdateRequest $request)
    {
        $user = $request->user();
        $user->update($request->input());
        return new UserResource($user);
    }


}