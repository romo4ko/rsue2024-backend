<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExerciseResource\Pages\CreateExercise;
use App\Filament\Resources\ExerciseResource\Pages\EditExercise;
use App\Filament\Resources\ExerciseResource\Pages\ListExercises;
use App\Filament\Resources\LessonResource\Pages;
use App\Filament\Resources\LessonResource\RelationManagers;
use App\Models\Lesson;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Уроки';

    protected static ?string $modeLabel = 'Уроки';

    protected static ?string $pluralModelLabel = 'Уроки';

    protected static ?string $breadcrumb = 'Уроки';

    protected static ?string $label = 'Урок';

    public static function getRecordTitle(?Model $record): string|null|Htmlable
    {
        return $record->name;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Название')
                    ->required()
                    ->columns(1),
                Forms\Components\Select::make('program_id')
                    ->relationship('program', 'name')
                    ->label('Программа')
                    ->required(),
                Forms\Components\TextInput::make('points')
                    ->label('Баллы за урок')
                    ->numeric(),
                Forms\Components\Section::make()->schema([
                    RichEditor::make('theory')
                        ->label('Теоретический материал')
                        ->required(),
                ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('program.name')
                    ->label('Программа')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('Задания')
                    ->color('success')
                    ->icon('heroicon-o-puzzle-piece')
                    ->url(
                        fn (Lesson $record): string => static::getUrl('exercises.index', [
                            'parent' => $record->id,
                        ])
                    ),
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
            'index' => Pages\ListLessons::route('/'),
            'create' => Pages\CreateLesson::route('/create'),
            'edit' => Pages\EditLesson::route('/{record}/edit'),

            'exercises.index' => ListExercises::route('/{parent}/exercises'),
            'exercises.create' => CreateExercise::route('/{parent}/exercises/create'),
            'exercises.edit' => EditExercise::route('/{parent}/exercises/{record}/edit'),
        ];
    }
}
