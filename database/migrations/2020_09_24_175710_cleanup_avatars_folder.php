<?php

use App\Models\Person;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CleanupAvatarsFolder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $usedAvatarFiles = Person::whereNotNull('avatar')->get(['avatar'])->pluck('avatar')->map(function ($item) {
            return "avatars/{$item}";
        });
        $storedAvatarFiles = collect(Storage::files('avatars'));
        $unusedAvatarFiles = $storedAvatarFiles->diff($usedAvatarFiles);
        Storage::delete($unusedAvatarFiles->toArray());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // No way back
    }
}
