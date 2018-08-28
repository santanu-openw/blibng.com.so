<?php

namespace Zix\Core\Events;

use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Zix\Analyser\Contracts\AnalysableEvent;
use Zix\Core\Models\Feedback;

/**
 * Class UserSubmittedFeedback
 * @package Zix\Core\Events
 */
class UserSubmittedFeedback implements AnalysableEvent, ShouldQueue
{
    /**
     * @var User
     */
    public $user;
    /**
     * @var Feedback
     */
    public $feedback;


    /**
     * UserSubmittedFeedback constructor.
     * @param User $user
     * @param Feedback $feedback
     */
    public function __construct(User $user, Feedback $feedback)
    {
        $this->user = $user;
        $this->feedback = $feedback;
    }


    /**
     * @return string
     */
    public function action(): string
    {
        return "feedback";
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return "user";
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
        return $this->feedback;
    }

    /**
     * @return mixed
     */
    public function data()
    {
        return [];
    }
}
