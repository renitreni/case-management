<?php

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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class);
            $table->string('first_name')->nullable(); // 'first_name',
            $table->string('middle_name')->nullable(); // 'middle_name',
            $table->string('last_name')->nullable(); // 'last_name',
            $table->string('gender')->nullable(); // 'gender',
            $table->string('email')->nullable(); // 'email',
            $table->string('phone_no')->nullable(); // 'phone_no',
            $table->string('phone_no_other')->nullable(); // 'phone_no_other',
            $table->string('address')->nullable(); // 'address',
            $table->string('city')->nullable(); // 'city',
            $table->string('state')->nullable(); // 'state',
            $table->string('country')->nullable(); // 'country'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
