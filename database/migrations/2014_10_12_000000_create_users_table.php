<?php

use App\Models\VaccineCenter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nid')->index()->unique();
            $table->string('email')->unique();
            $table->string('phone')->unique()->comment('Future SMS Feature');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->dateTime('registration_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('scheduled_at')->nullable();
            $table->enum('vaccine_status', ['Not Scheduled', 'Scheduled', 'Vaccinated'])->default('Not Scheduled');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
