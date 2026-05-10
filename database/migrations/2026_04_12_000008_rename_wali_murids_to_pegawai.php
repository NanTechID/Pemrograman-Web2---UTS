<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('wali_murids') && !Schema::hasTable('pegawai')) {
            Schema::rename('wali_murids', 'pegawai');
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('pegawai') && !Schema::hasTable('wali_murids')) {
            Schema::rename('pegawai', 'wali_murids');
        }
    }
};
