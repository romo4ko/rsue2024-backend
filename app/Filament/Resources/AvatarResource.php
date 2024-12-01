<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AvatarResource\Pages;
use App\Filament\Resources\AvatarResource\RelationManagers;
use App\Models\Avatar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AvatarResource extends Resource
{
    protected static ?string $model = Avatar::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?int $navigationSort = 7;

    protected static ?string $navigationLabel = 'Аватары';

    protected static ?string $modeLabel = 'Аватары';

    protected static ?string $pluralModelLabel = 'Аватары';

    protected static ?string $breadcrumb = 'Аватары';

    protected static ?string $label = 'Аватары';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->rules(['image'])
                    ->nullable()
                    ->image()
                    ->imageCropAspectRatio('1:1')
                    ->disk('public')
                    ->directory('avatars')
                    ->visibility('public')
                    ->maxWidth('xs')
                    ->label('Аватар'),
                Forms\Components\TextInput::make('price')
                    ->label('Цена')
                    ->numeric()
                    ->required()
                    ->maxWidth('sm'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Аватар'),
                Tables\Columns\TextColumn::make('price')
                    ->label('Цена'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListAvatars::route('/'),
            'create' => Pages\CreateAvatar::route('/create'),
            'edit' => Pages\EditAvatar::route('/{record}/edit'),
        ];
    }
}
