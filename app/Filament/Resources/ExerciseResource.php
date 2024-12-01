<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExerciseResource\Pages;
use App\Filament\Resources\ExerciseResource\RelationManagers;
use App\Models\Enums\ExerciseType;
use App\Models\Exercise;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class ExerciseResource extends Resource
{
    protected static ?string $model = Exercise::class;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationLabel = 'Задания';

    protected static ?string $modeLabel = 'Задания';

    protected static ?string $pluralModelLabel = 'Задания';

    protected static ?string $breadcrumb = 'Задания';

    protected static ?string $label = 'Задания';

    protected static bool $shouldRegisterNavigation = false;

    public static string $parentResource = LessonResource::class;

    public static function getRecordTitle(?Model $record): string|null|Htmlable
    {
        return $record->id;
    }

    public static function form(Form $form): Form
    {
        $record = $form->getRecord();

        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->label('Тип задания')
                    ->options([
                        ExerciseType::TEST->value => 'Тест',
                        ExerciseType::PRACTICE->value => 'Практика',
                        ExerciseType::MANUAL->value => 'Ручная проверка',
                    ])
                    ->maxWidth('xs'),
                Forms\Components\RichEditor::make('condition')
                    ->label('Условие')
                    ->required()
                    ->columns(1),
                $record->type === ExerciseType::TEST->value ?
                    Repeater::make('answers')
                        ->label('Ответы')
                        ->schema([
                            TextInput::make('text')
                                ->label('Ответ')
                                ->required(),
                            Forms\Components\Checkbox::make('isCorrect')
                                ->label('Правильный ответ')
                                ->default(false),
                        ])->columns(2)
                : Forms\Components\Section::make()->hidden(),
                Forms\Components\TextInput::make('points')
                    ->label('Баллы за задание')
                    ->numeric()
                    ->maxWidth('xs'),

            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('№'),
                Tables\Columns\TextColumn::make('role')
                    ->label('Тип задания')
                    ->getStateUsing(function (Exercise $exercise) {
                        return ExerciseType::getTranslations()[$exercise->type ?? ExerciseType::MANUAL] ?? '-';
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('condition')
                    ->label('Условие')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('points')
                    ->label('Баллы за задание')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->url(
                        fn (Pages\ListExercises $livewire, Model $record): string => static::$parentResource::getUrl('exercises.edit', [
                            'record' => $record,
                            'parent' => $livewire->parent,
                        ])
                    ),
                Tables\Actions\DeleteAction::make(),
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
}
