<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResearchResource\Pages;
use App\Models\Research;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Indicator;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ResearchResource extends Resource
{
    protected static ?string $model = Research::class;

    protected static ?string $slug = 'researches';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $modelLabel = 'research';

    protected static ?string $pluralModelLabel = 'researches';

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationLabel = 'Researches';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Research Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Title')
                                    ->placeholder('Enter title')
                                    ->required()
                                    ->markAsRequired(false)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug')
                                    ->disabled()
                                    ->dehydrated()
                                    ->unique(ignorable: fn ($record) => $record),
                                Forms\Components\Textarea::make('abstract')
                                    ->label('Abstract')
                                    ->placeholder('Enter abstract')
                                    ->autosize(),
                            ]),

                        Section::make()
                            ->schema([
                                Forms\Components\FileUpload::make('pdf_path')
                                    ->label('PDF File')
                                    ->openable()
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->disk('public')
                                    ->directory('pdf-files'),
                            ]),
                    ])
                    ->columnSpan(2),

                Forms\Components\Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                Forms\Components\Toggle::make('published')
                                    ->label('Published')
                                    ->default(false)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (Get $get, Set $set) {
                                        $title = $get('title');
                                        $set('slug', Str::slug($title));
                                    }),
                                Forms\Components\DatePicker::make('date_submitted')
                                    ->label('Date Submitted')
                                    ->default(now())
                                    ->maxDate(now())
                                    ->format('Y-m-d')
                                    ->native(false)
                                    ->closeOnDateSelection(),
                                Forms\Components\TagsInput::make('author')
                                    ->label('Authors')
                                    ->placeholder('Add author')
                                    ->separator(', '),
                                Forms\Components\TagsInput::make('keyword')
                                    ->label('Keywords')
                                    ->placeholder('Add keyword')
                                    ->separator(', '),
                            ]),

                        Section::make()
                            ->schema([
                                Forms\Components\Select::make('department_id')
                                    ->label('Department')
                                    ->placeholder('Select department')
                                    ->relationship('department', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->markAsRequired(false)
                                    ->native(false)
                                    ->createOptionForm([
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
                                Forms\Components\TagsInput::make('adviser')
                                    ->label('Adviser')
                                    ->placeholder('Add adviser')
                                    ->separator(', '),
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
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_submitted')
                    ->label('Date Submitted')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('published')
                    ->label('Published')
                    ->boolean(),
                Tables\Columns\TextColumn::make('author')
                    ->label('Authors')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('keyword')
                    ->label('Keywords')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('department.name')
                    ->label('Department')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('adviser')
                    ->label('Adviser')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Filters\Filter::make('date_submitted')
                    ->form([
                        DatePicker::make('submitted_from')
                            ->label('Submitted From')
                            ->maxDate(now())
                            ->native(false)
                            ->closeOnDateSelection(),
                        DatePicker::make('submitted_until')
                            ->label('Submitted Until')
                            ->maxDate(now())
                            ->native(false)
                            ->closeOnDateSelection(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['submitted_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date_submitted', '>=', $date),
                            )
                            ->when(
                                $data['submitted_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date_submitted', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['submitted_from'] ?? null) {
                            $indicators[] = Indicator::make('Submitted from '.Carbon::parse($data['submitted_from'])->toFormattedDateString())
                                ->removeField('submitted_from');
                        }

                        if ($data['submitted_until'] ?? null) {
                            $indicators[] = Indicator::make('Submitted until '.Carbon::parse($data['submitted_until'])->toFormattedDateString())
                                ->removeField('submitted_until');
                        }

                        return $indicators;
                    }),
                Tables\Filters\SelectFilter::make('department')
                    ->label('Department')
                    ->relationship('department', 'name')
                    ->searchable()
                    ->preload()
                    ->native(false),
                Tables\Filters\TernaryFilter::make('published')
                    ->label('Published')
                    ->placeholder('All researches')
                    ->trueLabel('Published researches')
                    ->falseLabel('Unpublished researches')
                    ->native(false),
                Tables\Filters\TrashedFilter::make()
                    ->label('Deleted Records')
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->successNotification(null)
                    ->after(function () {
                        Notification::make()
                            ->title('Research deleted')
                            ->body('A research has been deleted successfully.')
                            ->success()
                            ->send()
                            ->sendToDatabase(auth()->user());
                    }),
                Tables\Actions\ForceDeleteAction::make()
                    ->successNotification(null)
                    ->after(function () {
                        Notification::make()
                            ->title('Research force deleted')
                            ->body('A research has been force deleted successfully.')
                            ->success()
                            ->send()
                            ->sendToDatabase(auth()->user());
                    }),
                Tables\Actions\RestoreAction::make()
                    ->successNotification(null)
                    ->after(function () {
                        Notification::make()
                            ->title('Research restored')
                            ->body('A research has been restored successfully.')
                            ->success()
                            ->send()
                            ->sendToDatabase(auth()->user());
                    }),
            ])
            ->bulkActions([
                ExportBulkAction::make(),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->defaultSort('date_submitted', 'desc')
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
            'index' => Pages\ListResearch::route('/'),
            'create' => Pages\CreateResearch::route('/create'),
            'view' => Pages\ViewResearch::route('/{record}'),
            'edit' => Pages\EditResearch::route('/{record}/edit'),
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
