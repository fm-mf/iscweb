<?php

use App\Models\Person;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Ramsey\Uuid\Uuid;

class MoveAndRenameOldAvatars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $possibleAvatarExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'JPG', 'JPEG', 'PNG', 'GIF', 'BMP'];
        $peopleWithoutAvatar = Person::whereNull('avatar')->get();
        $peopleWithoutAvatar->each(function ($person) use ($possibleAvatarExtensions) {
            $avatarPaths = glob(storage_path('app/avatars/old/' . $person->id_user . '.{' . implode(',', $possibleAvatarExtensions)) . '}', GLOB_BRACE);
            $avatarPathsCount = count($avatarPaths);
            if ($avatarPathsCount === 1) {
                $newAvatarName = Uuid::uuid4() . '.' . File::extension($avatarPaths[0]);
                $person->avatar = $newAvatarName;
                $person->save();
                Storage::move(str_replace(storage_path('app/'), '', $avatarPaths[0]), 'avatars/' . $newAvatarName);
            } elseif ($avatarPathsCount > 1) {
                // Fix those manually
                echo "More avatars available: {$person->id_user} ({$avatarPathsCount})\n";
            }
        });
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
