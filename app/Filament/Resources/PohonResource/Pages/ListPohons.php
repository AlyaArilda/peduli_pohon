<?php

namespace App\Filament\Resources\PohonResource\Pages;

use App\Filament\Resources\PohonResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPohons extends ListRecords
{
    protected static string $resource = PohonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
