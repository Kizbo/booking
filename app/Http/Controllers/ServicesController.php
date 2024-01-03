<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class ServicesController extends Controller
{
    public function list()
    {
        $services = Service::all();

        $tableHeaders = [
            __("messages.name"),
            __("messages.price"),
            __("messages.duration"),
            __("messages.actions")
        ];

        $tableData = $services->map(function ($service){
            return [$service->name, $service->price . " " . Config::get("site_settings")->get("currency-symbol"), $service->duration . " min"];
        });

        $actions = [
            [
                "type" => "primary",
                "text" => __("messages.edit"),
                "name" => "admin.services.edit",
                "data" => $services->map(fn($service) => ['id' => $service->id])->toArray()
            ],
            [
                "type" => "delete",
                "text" => __("messages.delete"),
                "name" => "admin.services.delete",
                "data" => $services->map(fn($userData) => ['id' => $userData->id])->toArray()
            ]
        ];

        return view("pages.services", [
            'tableHeaders' => $tableHeaders,
            'tableData' => $tableData->toArray(),
            'tableActions' => $actions,
        ]);
    }

    public function create()
    {
        return view("pages.services.create");
    }

    public function edit()
    {
        return view("pages.services.edit");
    }

    public function delete($id)
    {
        $this->authorize("manipulate", Service::class);
        Service::where('id', '=', $id)->delete();

        return redirect()->route('admin.services');
    }
}
