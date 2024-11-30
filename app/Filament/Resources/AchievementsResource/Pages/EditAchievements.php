<?php

namespace App\Filament\Resources\AchievementsResource\Pages;

use App\Filament\Resources\AchievementsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAchievements extends EditRecord
{
    protected static string $resource = AchievementsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
