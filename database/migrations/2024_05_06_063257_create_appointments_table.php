<?php

use App\Models\Client;
use App\Models\Team;
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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Client::class); // 'client_id',
            $table->foreignIdFor(Team::class); // 'team_id',
            $table->string('phone_no')->nullable(); // 'phone_no',
            $table->dateTime('appointment_date'); // 'appointment_date',
            $table->string('status'); // 'status' // open, close, on-going, re-schedule, unattended
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
