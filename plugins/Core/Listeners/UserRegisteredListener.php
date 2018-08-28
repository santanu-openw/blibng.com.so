<?php

namespace Zix\Core\Listeners;


use App\User;
use Zix\Core\Events\UserRegistered;
use Zix\Core\Notifications\WelcomeToBling;
use Zix\Session\Events\CoachAssignedToParticipant;

/**
 * Class UserRegisteredListener
 * @package Zix\Core\Listeners
 */
class UserRegisteredListener
{


    /**
     * Handle the event.
     *
     * @param UserRegistered $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        if (!$event->user->roles()->count()) {
            $event->user->assignRole('Participant');

            $this->assignParticipantToCoach($event->user);
        }
        if (!app()->runningInConsole()) {
            $event->user->notify(new WelcomeToBling($event->user));
        }
    }

    /**
     * @param User $participant
     */
    private function assignParticipantToCoach(User $participant)
    {
        $coach = User::whereHas('roles', function ($query) {
            return $query->where('name', 'Coach');
        })->withCount('coachParticipants')->orderBy('coach_participants_count')->first();

        $coach->coachParticipants()->save($participant);
        // TODO:: send notification to the coach, and participant
        event(new CoachAssignedToParticipant($coach, $participant));
    }
}
