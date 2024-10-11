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
            $table->string('nid')->unique();
            $table->string('email')->unique();
            $table->string('phone')->unique()->nullable()->comment('Future SMS Feature');
            $table->foreignId('vaccine_center_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->dateTime('registration_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('scheduled_date')->nullable();
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
