<?php

use App\Models\Component;
use App\Models\Supplier;
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
        Schema::create('component_supplier', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Supplier::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Component::class)->constrained()->onDelete('cascade');
            $table->integer('price')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('component_supplier');
    }
};
