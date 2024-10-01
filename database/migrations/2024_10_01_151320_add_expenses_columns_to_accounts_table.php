<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->decimal('total_expenses', 10, 2)->default(0); // Add total_expenses column
            // or
            // $table->decimal('monthly_expenses', 10, 2)->default(0); // This might be your intended column
        });
    }

    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn('total_expenses'); // Ensure you drop the correct column if needed
            // or
            // $table->dropColumn('monthly_expenses');
        });
    }
};
