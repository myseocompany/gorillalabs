<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('labs', function (Blueprint $table) {
            $table->string('contact_person')->nullable()->after('name');
            $table->string('contact_phone')->nullable()->after('contact_person');
            $table->string('contact_email')->nullable()->after('contact_phone');
            $table->boolean('accreditation_onac')->default(false)->after('resolution_compliance');
            $table->boolean('accreditation_ideam')->default(false)->after('accreditation_onac');
        });
    }

    public function down(): void
    {
        Schema::table('labs', function (Blueprint $table) {
            $table->dropColumn(['contact_person', 'contact_phone', 'contact_email', 'accreditation_onac', 'accreditation_ideam']);
        });
    }
};
