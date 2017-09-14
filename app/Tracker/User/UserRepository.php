<?php
namespace App\Tracker\User;

/**
 * Class UserRepository
 * @package App\Http\Controllers
 */
class UserRepository
{
    /**
     * Creates the user if the user does not already exist
     * @param string $phone
     * @param string $email
     * @param integer $tenant
     * @return User
     */
    public function addIfNeeded($phone, $email, $tenant)
    {
        $user_hash = User::makeHash("t{$tenant}_{$phone}");

        /** @var User $user */
        $user = User::where(['hash' => $user_hash])->first();

        if (is_null($user)) {
            $user = User::create([
                'hash' => $user_hash,
                'phone' => $phone,
                'email' => $email,
                'tenant' => $tenant,
            ]);

        } else {
            // The only thing you can update is the email
            $user->email = $email;
            $user->save();
        }

        return $user;
    }
}
