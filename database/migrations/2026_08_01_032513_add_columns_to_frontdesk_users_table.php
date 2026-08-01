<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('frontdesk_users', function (Blueprint $table) {
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('employee_code')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->enum('shift', ['morning', 'afternoon', 'evening'])->default('morning');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->rememberToken();
        });
    }

    public function down(): void
    {
        Schema::table('frontdesk_users', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'email',
                'password',
                'employee_code',
                'phone',
                'shift',
                'status',
                'last_login_at',
                'last_login_ip',
                'remember_token'
            ]);
        });
    }
};