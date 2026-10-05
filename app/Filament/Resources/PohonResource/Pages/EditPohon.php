<?php

namespace App\Filament\Resources\PohonResource\Pages;

use App\Filament\Resources\PohonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPohon extends EditRecord
{
    protected static string $resource = PohonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
