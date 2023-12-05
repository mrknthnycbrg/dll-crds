<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $slug = 'categories';

    protected static ?string $modelLabel = 'category';

    protected static ?string $pluralModelLabel = 'categories';

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationLabel = 'Categories';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'Post Management';

    protected static ?string $navigationParentItem = 'Posts';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Name')
                                    ->placeholder('Enter name')
                                    ->required()
                                    ->markAsRequired(false)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug')
                                    ->disabled()
                                    ->dehydrated()
                                    ->unique(ignorable: fn ($record) => $record),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Deleted At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function (Tables\Actions\DeleteAction $action, Category $record) {
                        $id = $record->id;
                        $exists = Post::where('category_id', $id)->exists();

                        if ($exists) {
                            Notification::make()
                                ->title('Deletion not allowed')
                                ->danger()
                                ->send();

                            $action->cancel();
                        }
                    }),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                ExportBulkAction::make(),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->defaultSort('name', 'asc')
            ->persistSortInSession();
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'view' => Pages\ViewCategory::route('/{record}'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
