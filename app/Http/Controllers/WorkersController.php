<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class WorkersController extends Controller
{
    public function list()
    {
        $users = User::with("services")->get();

        $tableHeaders = [
            __("profile.first-name"),
            __("profile.last-name"),
            __("auth.email-field"),
            __("messages.services"),
            __("messages.actions")
        ];

        $data = $users->map(function ($user){
            return [$user->firstname, $user->lastname, $user->email, $user->services->pluck("name")->join(", ")];
        });

        $actions = [
            [
                "type" => "primary",
                "text" => __("messages.edit"),
                "name" => "admin.workers.edit",
                "data" => $users->map(fn($userData) => ['id' => $userData->id])->toArray()
            ]
        ];

        return view("pages.workers", [
            'tableHeaders' => $tableHeaders,
            'tableData' => $data->toArray(),
            'tableActions' => $actions,
        ]);
    }

    public function create()
    {
        return view("pages.workers.create");
    }

    public function edit()
    {
        return view("pages.workers.edit");
    }
}
