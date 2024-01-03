<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("value")->nullable();
            $table->timestamps();
        });

        /** default settings */
        DB::table("settings")->insert(
            [
                [
                    'name' => 'currency',
                    'value' => "PLN"
                ],
                [
                    'name' => 'currency-symbol',
                    'value' => "zł"
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
