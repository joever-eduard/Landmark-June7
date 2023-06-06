<?php

namespace App\Validators;

use App\Models\InvitationModel;
use CodeIgniter\Validation\Exceptions\ValidationException;

class UserValidator
{
    public function checkInvitationCode(string $str, string $field, array $data): bool
    {
        $invitationModel = new InvitationModel();
        $invitation = $invitationModel->where('code', $str)->first();

        return $invitation !== null;
    }
}
