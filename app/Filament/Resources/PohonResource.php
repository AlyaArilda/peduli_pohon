<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PohonResource\Pages;
use App\Models\Pohon;
use App\Models\Kategori;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PohonResource extends Resource
{
    protected static ?string $model = Pohon::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Pohon';
    protected static ?string $pluralLabel = 'Pohon';
    protected static ?string $modelLabel = 'Pohon';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_pohon')
                    ->label('Nama Pohon')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('kategori_id')
                    ->label('Kategori')
                    ->relationship('kategori', 'nama_kategori')
                    ->searchable()
                    ->required(),

                Forms\Components\FileUpload::make('gambar_pohon')
                    ->label('Gambar Pohon')
                    ->image()
                    ->directory('pohon-images')
                    ->required(),

                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->maxLength(65535),

                Forms\Components\RichEditor::make('manfaat')
                    ->label('Manfaat')
                    ->required(),

                Forms\Components\TextInput::make('nama_pj')
                    ->label('Nama Penanggung Jawab')
                    ->required()
                    ->maxLength(255),

                Forms\Components\FileUpload::make('foto_pj')
                    ->label('Foto Penanggung Jawab')
                    ->image()
                    ->directory('pj-foto')
                    ->required(),

                Forms\Components\TextInput::make('alamat')
                    ->label('Alamat')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('telp_pj')
                    ->label('No. Telepon Penanggung Jawab')
                    ->tel()
                    ->maxLength(20),

                Forms\Components\TextInput::make('tinggi')
                    ->label('Tinggi')
                    ->maxLength(255),

                Forms\Components\TextInput::make('tajuk')
                    ->label('Tajuk')
                    ->maxLength(255),

                Forms\Components\TagsInput::make('cocok_untuk')
                    ->label('Cocok Untuk'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_pohon')
                    ->label('Nama Pohon')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kategori.nama_kategori')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\ImageColumn::make('gambar_pohon')
                    ->label('Gambar'),

                Tables\Columns\TextColumn::make('nama_pj')
                    ->label('Penanggung Jawab'),

                Tables\Columns\ImageColumn::make('foto_pj')
                    ->label('Foto PJ'),

                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPohons::route('/'),
            'create' => Pages\CreatePohon::route('/create'),
            'edit' => Pages\EditPohon::route('/{record}/edit'),
        ];
    }
}
