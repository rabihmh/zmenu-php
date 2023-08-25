<?php

namespace App\Actions\Fortify;

use App\Actions\Fortify\Services\CreateUser;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    public CreateUser $createService;

    public function __construct(CreateUser $createUser)
    {
        $this->createService = $createUser;
    }

    /**
     * Validate and create a newly registered user.
     *
     * @param array<string, string> $input
     * @throws ValidationException
     */

    public function create(array $input): User|Admin
    {
        if (config('fortify.guard') === 'web')
            return $this->createService->createTenantAdmin($input);
        return $this->createService->createAdmin($input);

    }
}
