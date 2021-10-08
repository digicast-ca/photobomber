<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UploadPhotoController extends Controller
{
    public function __invoke(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        $path = $request->file('photo')->store('photos');

        return $user->photos()->create(['path' => $path]);
    }
}
