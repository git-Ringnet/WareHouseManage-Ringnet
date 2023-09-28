<?php

namespace App\Actions\Fortify;

use App\Models\ManagerLicense;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phonenumber' => ['nullable', 'numeric', 'digits_between:1,11'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phonenumber' => $input['phonenumber'],
            'password' => Hash::make($input['password']),
            'roleid' => 1,
        ]);

        // Thêm license_id
        $user->license_id = $user->id;
        $user->save();

        $date_end = now()->addDays(30);
        $data = [
            'user_id' => $user->id,
            'license_id' => 1,
            'date_start' => now(),
            'date_end' => $date_end,
        ];
        $managerLC = new ManagerLicense();
        $managerLC->createUserLicense($data);

        return $user;
    }
}
