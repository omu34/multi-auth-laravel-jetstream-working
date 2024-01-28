<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\EmployeeJobView;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input)
    {
        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
            'role_id' => ['required', 'in:2,3'], 
        ]);

        if ($input['role_id'] == 3) {
            $validator->addRules([
                'employee_job_id' => [
                    'required',
                    'string',
                    function ($attribute, $value, $fail) {
                        $employeeJob = EmployeeJobView::where('employee_job_id', $value)->first();
                        if (!$employeeJob) {
                            $fail('The selected job identity is not found.');
                        }
                    },
                    'unique:users,employee_job_id',
                ],
            ]);
        }

        $validator->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role_id' => $input['role_id'],
            'your_address' => $input['your_address'] ?? null,
            'your_phone_number' => $input['your_phone_number'] ?? null,
            'employee_job_id' => $input['role_id'] == 3 ? $input['employee_job_id'] : null,
        ]);

        return $user;
    }
}
