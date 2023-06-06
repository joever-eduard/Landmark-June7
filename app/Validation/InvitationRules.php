<?php

namespace App\Validation;

use CodeIgniter\Validation\Rules;

class InvitationRules extends Rules
{
    public function checkInvitationCode(string $str, string &$error = null): bool
    {
        // Define the valid invitation code(s)
        $validInvitationCodes = ['SPECIALCODE'];

        if (in_array($str, $validInvitationCodes)) {
            return true;
        }

        $error = 'Invalid invitation code.';
        return false;
    }
}