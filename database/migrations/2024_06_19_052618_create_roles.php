<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }
        if (!Role::where('name', 'tutor')->exists()) {
            Role::create(['name' => 'tutor']);
        }
        if (!Role::where('name', 'asesor')->exists()) {
            Role::create(['name' => 'asesor']);
        }
        if (!Role::where('name', 'estudiante')->exists()) {
            Role::create(['name' => 'estudiante']);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
