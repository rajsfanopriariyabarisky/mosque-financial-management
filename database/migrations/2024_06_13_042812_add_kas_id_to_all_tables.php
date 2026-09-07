<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKasIdToAllTables extends Migration
{
    public function up()
    {
        Schema::table('infaqs', function (Blueprint $table) {
            $table->foreignId('kas_id')->nullable()->constrained('kas')->onDelete('set null');
        });

        Schema::table('zakats', function (Blueprint $table) {
            $table->foreignId('kas_id')->nullable()->constrained('kas')->onDelete('set null');
        });

        Schema::table('qurbans', function (Blueprint $table) {
            $table->foreignId('kas_id')->nullable()->constrained('kas')->onDelete('set null');
        });

        Schema::table('parkirs', function (Blueprint $table) {
            $table->foreignId('kas_id')->nullable()->constrained('kas')->onDelete('set null');
        });

        Schema::table('kontribusis', function (Blueprint $table) {
            $table->foreignId('kas_id')->nullable()->constrained('kas')->onDelete('set null');
        });

        Schema::table('insidentals', function (Blueprint $table) {
            $table->foreignId('kas_id')->nullable()->constrained('kas')->onDelete('set null');
        });

        Schema::table('operasionals', function (Blueprint $table) {
            $table->foreignId('kas_id')->nullable()->constrained('kas')->onDelete('set null');
        });

        Schema::table('pengajians', function (Blueprint $table) {
            $table->foreignId('kas_id')->nullable()->constrained('kas')->onDelete('set null');
        });

        Schema::table('lainnyas', function (Blueprint $table) {
            $table->foreignId('kas_id')->nullable()->constrained('kas')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('infaqs', function (Blueprint $table) {
            $table->dropForeign(['kas_id']);
            $table->dropColumn('kas_id');
        });

        Schema::table('zakats', function (Blueprint $table) {
            $table->dropForeign(['kas_id']);
            $table->dropColumn('kas_id');
        });

        Schema::table('qurbans', function (Blueprint $table) {
            $table->dropForeign(['kas_id']);
            $table->dropColumn('kas_id');
        });

        Schema::table('parkirs', function (Blueprint $table) {
            $table->dropForeign(['kas_id']);
            $table->dropColumn('kas_id');
        });

        Schema::table('kontribusis', function (Blueprint $table) {
            $table->dropForeign(['kas_id']);
            $table->dropColumn('kas_id');
        });

        Schema::table('insidentals', function (Blueprint $table) {
            $table->dropForeign(['kas_id']);
            $table->dropColumn('kas_id');
        });

        Schema::table('operasionals', function (Blueprint $table) {
            $table->dropForeign(['kas_id']);
            $table->dropColumn('kas_id');
        });

        Schema::table('pengajians', function (Blueprint $table) {
            $table->dropForeign(['kas_id']);
            $table->dropColumn('kas_id');
        });

        Schema::table('lainnyas', function (Blueprint $table) {
            $table->dropForeign(['kas_id']);
            $table->dropColumn('kas_id');
        });
    }
}