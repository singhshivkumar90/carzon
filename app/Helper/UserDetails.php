<?php

namespace App\Helper;

use Illuminate\Support\Facades\Auth;

class UserDetails
{
    /**
     * @return array
     */
    public function getLoggedInUserAndRole(): array
    {
        $loggedInUser = Auth::user();
        $role = $loggedInUser->role()->first();

        $loggedInUserDetails = ['user' => $loggedInUser, 'role' => $role];

        return $loggedInUserDetails;
    }
}
