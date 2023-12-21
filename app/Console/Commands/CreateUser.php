<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\{confirm, password, text};

class CreateUser extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'booking:make:user {email} {phone_number} {firstname} {lastname} {password} {is_admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin user';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $args = $this->arguments();

        $user = new User;
        $user->password = Hash::make($args['password']);
        $user->is_admin = $args['is_admin'];

        $user->fill($args);
        $user->save();

        $this->info("Created user #{$user->id}");
    }


    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'email' => fn () => text(label: "Email", required: true),
            'password' => fn () => password(label: "Password", required: true),
            'firstname' => fn () => text(label: "First name", required: true),
            'lastname' => fn () => text(label: "Last name", required: true),
            'phone_number' => fn () => text(label: "Phone number", required: true),
            'is_admin' => fn () => confirm(label: "Is this user admin?", required: true)
        ];
    }
}
