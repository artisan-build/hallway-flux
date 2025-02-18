<?php

declare(strict_types=1);

use ArtisanBuild\HallwayFlux\Livewire\BookmarksComponent;
use ArtisanBuild\HallwayFlux\Livewire\CalendarComponent;
use ArtisanBuild\HallwayFlux\Livewire\ChannelComponent;
use ArtisanBuild\HallwayFlux\Livewire\ChannelsComponent;
use ArtisanBuild\HallwayFlux\Livewire\ChannelSettingsComponent;
use ArtisanBuild\HallwayFlux\Livewire\HelpComponent;
use ArtisanBuild\HallwayFlux\Livewire\LobbyComponent;
use ArtisanBuild\HallwayFlux\Livewire\MembersComponent;
use ArtisanBuild\HallwayFlux\Livewire\MentionsComponent;
use ArtisanBuild\HallwayFlux\Livewire\SettingsComponent;
use ArtisanBuild\HallwayFlux\Livewire\ThreadComponent;
use ArtisanBuild\HallwayFlux\Livewire\WelcomeComponent;

if (config('hallway-flux.serves_welcome')) {
    Route::middleware(['web', 'guest'])->get('/', WelcomeComponent::class)->name(config('hallway-flux.route-prefix').'welcome');
}

// These are routes that might be available to guests as well as members. Sometimes additional middleware is applied on
// the component level.
Route::prefix(config('hallway-flux.route-prefix'))
    ->name(config('hallway-flux.route-name-prefix'))
    ->middleware(['web'])
    ->group(function (): void {
        Route::get('/calendar/{range?}', CalendarComponent::class)->name('calendar');
        Route::prefix('/channel/{channel}')->group(function (): void {
            Route::get('/', ChannelComponent::class)->name('channel');
        });
        Route::get('/thread/{message}', ThreadComponent::class)->name('thread');
    });

Route::prefix(config('hallway-flux.route-prefix'))
    ->name(config('hallway-flux.route-name-prefix'))
    ->middleware(config('hallway-flux.middleware'))
    ->group(function (): void {

        Route::get('/lobby', LobbyComponent::class)->name('lobby');

        Route::get('/channels', ChannelsComponent::class)->name('channels');
        Route::get('/members', MembersComponent::class)->name('members');
        Route::get('/mentions', MentionsComponent::class)->name('mentions');
        Route::get('/bookmarks', BookmarksComponent::class)->name('bookmarks');
        Route::get('/settings', SettingsComponent::class)->name('settings');
        Route::get('/help', HelpComponent::class)->name('help');
        Route::prefix('/channel/{channel}')->group(function (): void {
            Route::get('/members', MembersComponent::class)->name('channel_members');
            Route::get('/settings', ChannelSettingsComponent::class)->name('channel_settings');
        });
    });
