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
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign("customers_reservation_id_foreign");

            $table->foreign("reservation_id")->references("id")->on("reservations")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign("customers_reservation_id_foreign");

            $table->foreign("reservation_id")->references("id")->on("reservations");
        });
    }
};
