<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramResource\Pages;
use App\Filament\Resources\ProgramResource\RelationManagers;
use App\Models\Program;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Курсы';

    protected static ?string $modeLabel = 'Курсы';

    protected static ?string $pluralModelLabel = 'Курсы';

    protected static ?string $breadcrumb = 'Курсы';

    protected static ?string $label = 'Курс';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Имя')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Описание')
                    ->required(),
                Forms\Components\FileUpload::make('image')
                    ->label('Изображение')
                    ->image(),
                Forms\Components\Select::make('user_id')
                    ->label('Преподаватели')
                    ->multiple()
                    ->preload()
                    ->relationship('users', 'name')
                    ->options(
                        User::role('teacher')->get()->pluck('full_name', 'id')
                    ),
                Forms\Components\TextInput::make('min_student_age')
                    ->label('Минимальный возраст ученика')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->maxValue(99)
                    ->maxWidth('xs'),
                Forms\Components\TextInput::make('max_student_age')
                    ->label('Максимальный возраст ученика')
                    ->numeric()
                    ->default(15)
                    ->minValue(0)
                    ->maxValue(99)
                    ->maxWidth('xs'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Имя')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Описание')
                    ->limit(40)
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Изображение'),
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
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
        ];
    }
}
