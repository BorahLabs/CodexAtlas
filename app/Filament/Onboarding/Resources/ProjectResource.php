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
                    ->columns(2),
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
            RelationManagers\ConceptsRelationManager::class,
            RelationManagers\RepositoriesRelationManager::class,
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
}
