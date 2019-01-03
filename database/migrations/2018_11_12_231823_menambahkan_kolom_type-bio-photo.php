<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MenambahkanKolomTypeBioPhoto extends Migration
{
    protected $type = 'user';
    protected  $photo = 'profile.svg';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('users', function (Blueprint $table) {
            $table->string('type')->default($this->type)->after('password');
            $table->mediumText('bio')->nullable()->after('type');
            $table->string('photo')->default($this->photo)->after('bio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('bio');
            $table->dropColumn('photo');
        });
    }
}
