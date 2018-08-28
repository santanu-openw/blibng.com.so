<?php

namespace Zix\Core\Events\Analytics;

use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Zix\Analyser\Contracts\AnalysableEvent;

class UpdateProfileEvent implements AnalysableEvent, ShouldQueue
{
    /**
     * @var User
     */
    public $user;


    /**
     * UpdateProfileEvent constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * @return string
     */
    public function action(): string
    {
        return "update";
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return "profile";
    }

    /**
     * @return User
     */
    public function user(): User
    {
        return $this->user;
    }

    /**
     * @return Model
     */
    public function model(): Model
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function data()
    {
        return [];
    }
}
