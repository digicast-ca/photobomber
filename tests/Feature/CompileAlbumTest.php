<?php

namespace Tests\Feature;

use App\Models\Album;
use App\Models\Photo;
use App\Models\User;
use App\Services\AlbumCompiler;
use Digi\Events\CompilationFailed;
use Digi\Events\CompilationFinished;
use Digi\Exceptions\NotEnoughPhotosException;
use Digi\Exceptions\PhotobombingLevelsTooLowException;
use Digi\Exceptions\TooManyPhotosException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class CompileAlbumTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_compiles_album()
    {
        Event::fake();

        config()->set('services.digi_compiler.min_album_photo_count', 1);
        config()->set('services.digi_compiler.max_album_photo_count', 10);
        config()->set('services.digi_compiler.chance_of_low_photobombing_levels_exception', 0);

        /** @var AlbumCompiler $compiler */
        $compiler = app(AlbumCompiler::class);

        /** @var User $user */
        $user = User::factory()->createOne();

        /** @var Album $album */
        $album = Album::factory()
            ->has(
                Photo::factory()
                    ->count(5)
                    ->state(fn (array $attributes) => ['user_id' => $user->id])
            )
            ->create(['user_id' => $user->id]);

        $compiler->compile($album);

        Event::assertDispatched(CompilationFinished::class);
        Event::assertNotDispatched(CompilationFailed::class);
    }

    /** @test */
    public function it_fails_to_compile_album_when_not_enough_photos()
    {
        Event::fake();

        config()->set('services.digi_compiler.min_album_photo_count', 10);
        config()->set('services.digi_compiler.max_album_photo_count', 20);
        config()->set('services.digi_compiler.chance_of_low_photobombing_levels_exception', 0);

        /** @var AlbumCompiler $compiler */
        $compiler = app(AlbumCompiler::class);

        /** @var User $user */
        $user = User::factory()->createOne();

        /** @var Album $album */
        $album = Album::factory()
            ->has(
                Photo::factory()
                    ->count(5)
                    ->state(fn (array $attributes) => ['user_id' => $user->id])
            )
            ->create(['user_id' => $user->id]);

        $compiler->compile($album);

        Event::assertNotDispatched(CompilationFinished::class);
        Event::assertDispatched(fn (CompilationFailed $event) => is_a($event->throwable, NotEnoughPhotosException::class));
    }

    /** @test */
    public function it_fails_to_compile_album_when_too_many_photos()
    {
        Event::fake();

        config()->set('services.digi_compiler.min_album_photo_count', 1);
        config()->set('services.digi_compiler.max_album_photo_count', 10);
        config()->set('services.digi_compiler.chance_of_low_photobombing_levels_exception', 0);

        /** @var AlbumCompiler $compiler */
        $compiler = app(AlbumCompiler::class);

        /** @var User $user */
        $user = User::factory()->createOne();

        /** @var Album $album */
        $album = Album::factory()
            ->has(
                Photo::factory()
                    ->count(15)
                    ->state(fn (array $attributes) => ['user_id' => $user->id])
            )
            ->create(['user_id' => $user->id]);

        $compiler->compile($album);

        Event::assertNotDispatched(CompilationFinished::class);
        Event::assertDispatched(fn (CompilationFailed $event) => is_a($event->throwable, TooManyPhotosException::class));
    }

    /** @test */
    public function it_fails_to_compile_album_when_low_photobombing_levels()
    {
        Event::fake();

        config()->set('services.digi_compiler.min_album_photo_count', 1);
        config()->set('services.digi_compiler.max_album_photo_count', 10);
        config()->set('services.digi_compiler.chance_of_low_photobombing_levels_exception', 100);

        /** @var AlbumCompiler $compiler */
        $compiler = app(AlbumCompiler::class);

        /** @var User $user */
        $user = User::factory()->createOne();

        /** @var Album $album */
        $album = Album::factory()
            ->has(
                Photo::factory()
                    ->count(5)
                    ->state(fn (array $attributes) => ['user_id' => $user->id])
            )
            ->create(['user_id' => $user->id]);

        $compiler->compile($album);

        Event::assertNotDispatched(CompilationFinished::class);
        Event::assertNotDispatched(fn (CompilationFailed $event) => is_a($event->throwable, NotEnoughPhotosException::class));
        Event::assertNotDispatched(fn (CompilationFailed $event) => is_a($event->throwable, TooManyPhotosException::class));
        Event::assertDispatched(fn (CompilationFailed $event) => is_a($event->throwable, PhotobombingLevelsTooLowException::class));
    }
}
