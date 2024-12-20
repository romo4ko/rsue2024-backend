<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Enums\Roles;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Пользователи';

    protected static ?string $modeLabel = 'Пользователи';

    protected static ?string $pluralModelLabel = 'Пользователи';

    protected static ?string $breadcrumb = 'Пользователи';

    protected static ?string $label = 'Пользователя';

    public static function form(Form $form): Form
    {
        $record = $form->getRecord();
        $role = $record?->getRoleNames()->first();

        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->email(),
                Forms\Components\TextInput::make('login')
                    ->required(),
                Forms\Components\Select::make('role')
                    ->label('Роль')
                    ->options(Roles::getTranslations())
                    ->default($role),
                Forms\Components\TextInput::make('password')
                    ->hiddenOn('edit')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create'),
                Forms\Components\Section::make()->schema([
                    Forms\Components\TextInput::make('name')->label('Имя')
                        ->required(),
                    Forms\Components\TextInput::make('surname')->label('Фамилия')->required(),
                    Forms\Components\TextInput::make('patronymic')->label('Отчество'),
                    Forms\Components\Textarea::make('about')->label('О себе')->rows(5),
                ])->columns(),
                Forms\Components\TextInput::make('telegram_username')
                    ->label('Telegram username')
                    ->disabled()
                    ->unique()
                    ->nullable(),
                Forms\Components\TextInput::make('telegram_id')
                    ->label('Telegram ID')
                    ->disabled()
                    ->nullable(),
                $record->role === Roles::STUDENT->value ? Forms\Components\Section::make()->schema([
                    Forms\Components\Select::make('achievements')
                        ->label('Достижения')
                        ->relationship('achievements', 'name')
                        ->preload()
                        ->multiple()
                        ->columns(1),
                ])
                : Forms\Components\Section::make()->hidden(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Имя')
                    ->searchable(),
                Tables\Columns\TextColumn::make('surname')
                    ->label('Фамилия')
                    ->default('-')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Почта')
                    ->default('-')
                    ->searchable(),
                Tables\Columns\TextColumn::make('login')
                    ->label('Логин')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Роль')
                    ->getStateUsing(function (User $user) {
                        return Roles::getTranslations()[$user->getRoleNames()->first()] ?? '-';
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Filter::make('is_confirmed')
                    ->checkbox()
                    ->query(fn (Builder $query): Builder => $query->whereNot('is_confirmed', true))
                    ->label('Не верифицированные'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Управление'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
