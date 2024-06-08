<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Filament\Resources\ProdukResource\RelationManagers;
use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kd_material')->label('Kode Material')->required()->extraAttributes([
                    'onkeydown' => "return event.key >= '0' && event.key <= '9' || event.key == 'Backspace' || event.key == 'Delete' || event.key == 'ArrowLeft' || event.key == 'ArrowRight' || event.key == 'Tab';"
                ]),
                TextInput::make('kd_produk')->label('Nama Produk'),
                TextInput::make('deskripsi')->label('Deskripsi'),
                TextInput::make('speed')->label('RPM')->numeric()->inputMode('Decimal'),
                TextInput::make('isi_dus')->label('Isi Dus')->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No')
                    ->getStateUsing(function ($rowLoop, $record) {
                        return $rowLoop->iteration;
                    }),
                Tables\Columns\TextColumn::make('kd_material')->label('Kode Material')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('kd_produk')->label('Nama Flavour')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('deskripsi')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('speed')->label('RPM')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('isi_dus')->label('Isi Dus')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label(false),
                Tables\Actions\DeleteAction::make()->label(false),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }
}
