<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileToUsersTable extends Migration
{
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        if (!Schema::hasColumn('users', 'image_path')) {
            $table->string('image_path')->nullable();
        }
        if (!Schema::hasColumn('users', 'postal_code')) {
            $table->string('postal_code')->nullable();
        }
        if (!Schema::hasColumn('users', 'address')) {
            $table->string('address')->nullable();
        }
        if (!Schema::hasColumn('users', 'building')) {
            $table->string('building')->nullable();
        }
    });
}

}
