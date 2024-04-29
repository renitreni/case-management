<?php

use App\Models\CaseItem;
use App\Models\Client;
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
        Schema::create('case_clients', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CaseItem::class);
            $table->foreignIdFor(Client::class);
            $table->string('client_type');
            $table->string('respondent_name');
            $table->string('respondent_advocate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_clients');
    }
};
