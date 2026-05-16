<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('services', function (Blueprint $t) {
            $t->string('name_zh_CN')->nullable()->after('name');
            $t->string('name_zh_TW')->nullable()->after('name_zh_CN');
            $t->text('description_zh_CN')->nullable()->after('description');
            $t->text('description_zh_TW')->nullable()->after('description_zh_CN');
        });

        Schema::table('branches', function (Blueprint $t) {
            $t->string('name_zh_CN')->nullable()->after('name');
            $t->string('name_zh_TW')->nullable()->after('name_zh_CN');
        });

        Schema::table('sections', function (Blueprint $t) {
            $t->string('name_zh_CN')->nullable()->after('name');
            $t->string('name_zh_TW')->nullable()->after('name_zh_CN');
            $t->text('description_zh_CN')->nullable()->after('description');
            $t->text('description_zh_TW')->nullable()->after('description_zh_CN');
        });

        Schema::table('charges', function (Blueprint $t) {
            $t->string('label_zh_CN')->nullable()->after('label');
            $t->string('label_zh_TW')->nullable()->after('label_zh_CN');
        });
    }

    public function down(): void
    {
        Schema::table('services', fn (Blueprint $t) => $t->dropColumn(['name_zh_CN', 'name_zh_TW', 'description_zh_CN', 'description_zh_TW']));
        Schema::table('branches', fn (Blueprint $t) => $t->dropColumn(['name_zh_CN', 'name_zh_TW']));
        Schema::table('sections', fn (Blueprint $t) => $t->dropColumn(['name_zh_CN', 'name_zh_TW', 'description_zh_CN', 'description_zh_TW']));
        Schema::table('charges', fn (Blueprint $t) => $t->dropColumn(['label_zh_CN', 'label_zh_TW']));
    }
};
