<?php

namespace Zix\Core\Events\Analytics;

use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Zix\Analyser\Contracts\AnalysableEvent;

class ViewedProfileEvent implements AnalysableEvent, ShouldQueue
{
    /**
     * @var User
     */
    public $user;


    /**
     * ViewedProfileEvent constructor.
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
        return "view";
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
