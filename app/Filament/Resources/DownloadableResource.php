<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DownloadableResource\Pages;
use App\Models\Downloadable;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class DownloadableResource extends Resource
{
    protected static ?string $model = Downloadable::class;

    protected static ?string $slug = 'downloadables';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'downloadable';

    protected static ?string $pluralModelLabel = 'downloadables';

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-down';

    protected static ?string $navigationLabel = 'Downloadables';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'Post Management';

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
                                    ->required()
                                    ->markAsRequired(false)
                                    ->unique(ignorable: fn ($record) => $record),
                                Forms\Components\FileUpload::make('downloadable_path')
                                    ->label('File')
                                    ->required()
                                    ->markAsRequired(false)
                                    ->openable()
                                    ->disk('public')
                                    ->directory('downloadable-files'),
                            ]),
                    ])
                    ->columnSpan(2),

                Forms\Components\Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                Forms\Components\Toggle::make('published')
                                    ->label('Published')
                                    ->default(false),
                                Forms\Components\DatePicker::make('date_published')
                                    ->label('Date Published')
                                    ->default(now())
                                    ->maxDate(now())
                                    ->format('Y-m-d')
                                    ->native(false)
                                    ->closeOnDateSelection(),
                            ]),
                    ])
                    ->columnSpan(1),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_published')
                    ->label('Date Published')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('published')
                    ->label('Published')
                    ->boolean(),
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
                Tables\Filters\TernaryFilter::make('published')
                    ->label('Published')
                    ->placeholder('All downloadables')
                    ->trueLabel('Published downloadables')
                    ->falseLabel('Unpublished downloadables'),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                ExportBulkAction::make(),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->defaultSort('date_published', 'desc')
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
            'index' => Pages\ListDownloadables::route('/'),
            'create' => Pages\CreateDownloadable::route('/create'),
            'view' => Pages\ViewDownloadable::route('/{record}'),
            'edit' => Pages\EditDownloadable::route('/{record}/edit'),
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
