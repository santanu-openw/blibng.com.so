<?php

namespace Zix\Core\Events\Analytics;

use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Zix\Analyser\Contracts\AnalysableEvent;

class UserLogin implements AnalysableEvent,ShouldQueue
{
    /**
     * @var User
     */
    private $user;


    /**
     * UserLogin constructor.
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
        return "login";
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
     * @return string
     */
    public function type(): string
    {
        return "user";
    }

    /**
     * @return mixed
     */
    public function data()
    {
       return [];
    }
}
