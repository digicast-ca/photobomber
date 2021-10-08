<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PhotoUploadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_uploads_a_photo()
    {
        Storage::fake();

        /** @var User $user */
        $user = User::factory()->create();

        $file = UploadedFile::fake()->image('sunset.jpg');

        $response = $this->actingAs($user)->post('photos', ['photo' => $file]);

        $response->assertCreated();

        Storage::disk()->assertExists($file->hashName('photos'));

        $this->assertDatabaseHas('photos', [
            'user_id' => $user->id,
            'path' => $file->hashName('photos'),
        ]);
    }
}
