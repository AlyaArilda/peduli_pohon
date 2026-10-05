<?php

namespace App\Filament\Resources\PohonResource\Pages;

use App\Filament\Resources\PohonResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePohon extends CreateRecord
{
    protected static string $resource = PohonResource::class;

    protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}

}
