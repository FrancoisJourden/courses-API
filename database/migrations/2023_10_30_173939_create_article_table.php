<?php

use App\Models\Commission;
use App\Models\Item;
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
        Schema::create('article', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Item::class)->nullable();
            $table->foreignIdFor(Commission::class)->nullable();
            $table->integer("quantity")->nullable();
            $table->timestamp("taken")->nullable();
            $table->timestamp("canceled")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article');
    }
};
