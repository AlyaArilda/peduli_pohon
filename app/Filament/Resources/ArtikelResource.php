<?php

namespace App\Filament\Resources;

use App\Models\Artikel;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\ArtikelResource\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class ArtikelResource extends Resource
{
    protected static ?string $model = Artikel::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Artikel';
    protected static ?string $pluralModelLabel = 'Artikel';
    protected static ?string $modelLabel = 'Artikel';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('judul_artikel')
                    ->label('Judul Artikel')
                    ->required()
                    ->maxLength(255),

                TextInput::make('penganalisa')
                    ->label('Penganalisa')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('foto_penganalisa')
                    ->label('Foto Penganalisa')
                    ->image()
                    ->directory('penganalisa')
                    ->disk('public')
                    ->nullable(),

                Forms\Components\FileUpload::make('gambar')
                    ->label('Gambar')
                    ->image()
                    ->directory('artikel')
                    ->disk('public')
                    ->required(), 

                Textarea::make('isi_artikel')
                    ->label('Isi Artikel')
                    ->required()
                    ->rows(8),

                TimePicker::make('waktu_update')
                    ->label('Waktu Update')
                    ->seconds(false)
                    ->required(),

                DatePicker::make('tanggal')
                    ->label('Tanggal')
                    ->default(now())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('gambar')
                    ->label('Gambar')
                    ->disk('public')
                    ->height(60),

                ImageColumn::make('foto_penganalisa')
                    ->label('Foto Penganalisa')
                    ->disk('public')
                    ->height(60),

                TextColumn::make('judul_artikel')
                    ->label('Judul')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('penganalisa')
                    ->label('Penganalisa')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d M Y'),

                TextColumn::make('waktu_update')
                    ->label('Waktu')
                    ->time('H:i'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArtikels::route('/'),
            'create' => Pages\CreateArtikel::route('/create'),
            'edit' => Pages\EditArtikel::route('/{record}/edit'),
        ];
    }
}
