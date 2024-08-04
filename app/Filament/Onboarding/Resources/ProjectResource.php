<?php

namespace App\Filament\Onboarding\Resources;

use App\Actions\Onboarding\GenerateProjectDescriptionFromUrl;
use App\Filament\Onboarding\Resources\ProjectResource\Pages;
use App\Filament\Onboarding\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube-transparent';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make(static::getCreationForm())
                    ->columnSpanFull()
                    ->columns(1)
                    ->visibleOn('create'),
                Forms\Components\Group::make(static::getEditForm())
                    ->columnSpanFull()
                    ->columns(1)
                    ->visibleOn('edit'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name'),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }

    private static function getCreationForm(bool $collapsible = false)
    {
        return [
            Forms\Components\Section::make('Basic information')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('public_url')
                        ->maxLength(255)
                        ->url()
                        ->live()
                        ->helperText('URL of the website or platform, starting with https://...'),
                    Forms\Components\MarkdownEditor::make('context')
                        ->label('What is it about?')
                        ->required()
                        ->helperText('Give a brief description of the project, its purpose, and the problem it solves. You can use markdown to format the text.')
                        ->maxLength(10000)
                        ->columnSpanFull()
                        ->hintActions([
                            Forms\Components\Actions\Action::make('generate')
                                ->label('Generate from URL')
                                ->disabled(fn (Get $get) => ! filter_var($get('public_url'), FILTER_VALIDATE_URL))
                                ->action(function (Get $get, Set $set) {
                                    try {
                                        $description = GenerateProjectDescriptionFromUrl::run($get('public_url'));
                                        $set('context', $description);
                                    } catch (\Exception $e) {
                                        Notification::make()
                                            ->title('Failed to generate description')
                                            ->body('We could not generate a description from the provided URL. Please, try again or enter it manually.')
                                            ->danger()
                                            ->send();
                                    }
                                }),
                        ]),
                ])
                ->columns(2)
                ->collapsible($collapsible)
                ->collapsed($collapsible)
                ->icon(function ($context, Get $get) {
                    if ($context === 'create') {
                        return null;
                    }

                    return 'heroicon-o-check-circle';
                })
                ->iconColor('success'),
        ];
    }

    private static function getEditForm(): array
    {
        return [
            Forms\Components\Wizard::make([
                Forms\Components\Wizard\Step::make('Project context')
                    ->schema([
                        ...static::getCreationForm(collapsible: true),
                        Forms\Components\Section::make('Glossary')
                            ->description('Explain terms that are specific to this project and might help your team understand better.')
                            ->schema([
                                Forms\Components\Repeater::make('concepts')
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\MarkdownEditor::make('description')
                                            ->required()
                                            ->maxLength(500),
                                    ])
                                    ->relationship('concepts')
                                    ->reorderable()
                                    ->orderColumn('order')
                                    ->live()
                                    ->label(false)
                                    ->addActionLabel('Add term'),
                            ])
                            ->icon(fn (Get $get) => $get('concepts') ? 'heroicon-o-check-circle' : 'heroicon-o-clock')
                            ->iconColor(fn (Get $get) => $get('concepts') ? 'success' : 'gray')
                            ->collapsible(true)
                            ->collapsed(true),
                        Forms\Components\Section::make('Relevant links')
                            ->description('Add URLs that are important for a new developer. This could include the different environments or tools that they might use.')
                            ->schema([
                                Forms\Components\Repeater::make('relevant_links')
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->maxLength(64)
                                            ->helperText('Max 64 characters'),
                                        Forms\Components\TextInput::make('url')
                                            ->required()
                                            ->url()
                                            ->maxLength(512)
                                            ->helperText('Max 512 characters'),
                                        Forms\Components\Checkbox::make('show_in_sidebar')
                                            ->default(true)
                                            ->inline(false),
                                    ])
                                    ->relationship('relevantLinks')
                                    ->reorderable()
                                    ->orderColumn('order')
                                    ->live()
                                    ->label(false)
                                    ->addActionLabel('Add link')
                                    ->columns(3),
                            ])
                            ->icon(fn (Get $get) => $get('relevant_links') ? 'heroicon-o-check-circle' : 'heroicon-o-clock')
                            ->iconColor(fn (Get $get) => $get('relevant_links') ? 'success' : 'gray')
                            ->collapsible(true)
                            ->collapsed(true),
                    ]),
                    Forms\Components\Wizard\Step::make('Dev environment')
                        ->schema([

                        ])
            ]),
        ];
    }
}
