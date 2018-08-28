<?php namespace Zix\Core\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Zix\Core\Events\UserRegistered;
use Zix\Core\Http\Requests\Admin\User as UserRequests;
use Zix\Core\Http\Resources\Admin\UserResource;

//use Zix\Core\Events\Participant as UserEvents;

/**
 * Class UserController
 * @package Zix\Core\Http\Controllers
 * @resource Admin Users
 */
class UserController
{
    /**
     * UserController constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * All
     * @param UserRequests\UserShowRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(UserRequests\UserShowRequest $request)
    {
        return datatables()->eloquent($this->model->with('roles'))->toJson();
    }

    /**
     * Show
     * @param UserRequests\UserShowRequest $request
     * @param User $user
     * @return UserResource
     */
    public function show(UserRequests\UserShowRequest $request, User $user)
    {
        return new UserResource($user);
    }

    /**
     * Store
     *
     * @param  UserRequests\UserStoreRequest $request
     * @return UserResource
     */
    public function store(UserRequests\UserStoreRequest $request)
    {
        $model = $this->storeUserData($request);

        $this->updateUserRoles($request, $model);

        event(new UserRegistered($model));

        return new UserResource($model);
    }

    /**
     * Update
     *
     * @param  User $user
     * @param  UserRequests\UserUpdateRequest $request
     * @return UserResource
     */
    public function update(UserRequests\UserUpdateRequest $request, User $user)
    {
        $user->update($request->input());

        $user->roles()->sync(collect($request->get('roles'))->pluck('id'));

        return new UserResource($user);
    }


    public function updateAvatar(Request $request, User $user)
    {
        if ($request->hasFile('avatar')) {
            $user->getMedia('avatars')->map(function ($image) {
                $image->delete();
            });

            $user->avatar = $user->addMedia($request->file('avatar'))->usingFileName('avatar.png')->toMediaCollection('avatars')->getUrl();
            $user->save();
        }

        return new UserResource($user);
    }

    /**
     * Destroy
     * @param UserRequests\UserDestroyRequest $request
     * @param User $user
     * @return UserResource
     * @throws \Exception
     */
    public function destroy(UserRequests\UserDestroyRequest $request, User $user)
    {
        $user->delete();

        return new UserResource($user);
    }

    /**
     * @param UserRequests\UserStoreRequest $request
     * @return mixed
     */
    protected function storeUserData(UserRequests\UserStoreRequest $request)
    {
        $model = $this->model->create(array_merge(
            $request->input(),
            ['user_id' => $this->getUserId(), 'password' => bcrypt($request->get('password'))]
        ));
        return $model;
    }

    /**
     * @param UserRequests\UserStoreRequest $request
     * @param $model
     */
    protected function updateUserRoles(UserRequests\UserStoreRequest $request, $model): void
    {
        collect($request->get('roles'))->map(function ($role) use ($model) {
            $model->assignRole($role['name']);
        });
    }

    /**
     * @return string
     */
    protected function getUserId(): string
    {
        if (User::all()->count()) {
            $latest_id = (int)User::orderByDesc('user_id')->first()->user_id;
        } else {
            $latest_id = 0;
        }
        return str_pad(($latest_id + 1), 4, "0", STR_PAD_LEFT);
    }
}