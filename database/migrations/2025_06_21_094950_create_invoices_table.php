<?php

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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('invoice_no')->unique();
            $table->string('billed_name');
            $table->text('billed_address');
            $table->string('billed_phone');
            $table->string('shipped_name');
            $table->text('shipped_address');
            $table->string('shipped_phone');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax', 5, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
