<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LaporanResource\Pages;
use App\Models\Laporan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LaporanResource extends Resource
{
    protected static ?string $model = Laporan::class;

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-circle';
    protected static ?string $navigationLabel = 'Laporan Kerusakan';
    protected static ?string $pluralLabel = 'Laporan Kerusakan';
    protected static ?string $modelLabel = 'Laporan';
    protected static ?int $navigationSort = 6;


    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('lokasi_pohon')
                ->label('Lokasi Pohon')
                ->required()
                ->maxLength(255),

            Forms\Components\DateTimePicker::make('waktu_ditemukan')
                ->label('Waktu Ditemukan')
                ->required(),

            Forms\Components\Textarea::make('deskripsi_kerusakan')
                ->label('Deskripsi Kerusakan')
                ->required()
                ->rows(5),

            Forms\Components\FileUpload::make('foto_kerusakan')
                ->label('Foto Kerusakan')
                ->directory('kerusakan-foto')
                ->image()
                ->required(),

            Forms\Components\TextInput::make('nama_pelapor')
                ->label('Nama Pelapor')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('telp')
                ->label('Nomor Telepon')
                ->tel()
                ->required(),

            Forms\Components\TextInput::make('email')
                ->label('Email')
                ->email()
                ->required(),

            Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'terkirim' => 'Terkirim',
                    'diproses' => 'Diproses',
                    'selesai' => 'Selesai',
                    'ditolak' => 'Ditolak',
                ])
                ->default('terkirim')
                ->required(),

            Forms\Components\FileUpload::make('foto_perbaikan')
                ->label('Foto Setelah Perbaikan')
                ->directory('laporan_perbaikan')
                ->image()
                ->nullable(),

            Forms\Components\Textarea::make('deskripsi_perbaikan')
                ->label('Deskripsi Perbaikan')
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('lokasi_pohon')
                ->label('Lokasi')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('waktu_ditemukan')
                ->label('Waktu Ditemukan')
                ->formatStateUsing(function ($state) {
                    try {
                        foreach (['Y-m-d H:i', 'd-m-Y H:i', 'd/m/Y H:i'] as $format) {
                            try {
                                return \Carbon\Carbon::createFromFormat($format, $state)->format('d M Y H:i');
                            } catch (\Exception $e) {}
                        }
                    } catch (\Exception $e) {}
                    return $state;
                }),

            Tables\Columns\TextColumn::make('nama_pelapor')
                ->label('Pelapor')
                ->searchable(),

            Tables\Columns\TextColumn::make('telp')
                ->label('Telepon'),

            Tables\Columns\TextColumn::make('email')
                ->label('Email'),

            Tables\Columns\ImageColumn::make('foto_kerusakan')
                ->label('Foto')
                ->circular(),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Dilaporkan Pada')
                ->dateTime('d M Y H:i')
                ->sortable(),

            Tables\Columns\BadgeColumn::make('status')
                ->label('Status')
                ->colors([
                    'terkirim' => 'warning',
                    'diproses' => 'info',
                    'selesai' => 'success',
                    'ditolak' => 'danger',
                ])
                ->formatStateUsing(fn ($state) => match ($state) {
                    'terkirim' => 'Terkirim',
                    'diproses' => 'Diproses',
                    'selesai' => 'Selesai',
                    'ditolak' => 'Ditolak',
                    default => $state,
                }),
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'terkirim' => 'Terkirim',
                    'diproses' => 'Diproses',
                    'selesai' => 'Selesai',
                    'ditolak' => 'Ditolak',
                ]),
        ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLaporans::route('/'),
            'create' => Pages\CreateLaporan::route('/create'),
            'edit' => Pages\EditLaporan::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

}
