<?php

use App\Models\CaseItem;
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task_name');
            $table->foreignIdFor(CaseItem::class);
            $table->foreignIdFor(Team::class);
            $table->date('start_date'); //'start_date',
            $table->date('end_date'); //'end_date',
            $table->string('status'); // completed, not started, in progress
            $table->string('priority'); // High, Medium, Low
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
