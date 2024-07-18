<?php

namespace App\Filament\Onboarding\Resources;

use App\Enums\SourceCodeProvider;
use App\Filament\Onboarding\Resources\RepositoryResource\Pages;
use App\Filament\Onboarding\Resources\RepositoryResource\RelationManagers;
use App\Models\Project;
use App\Models\Repository;
use App\Models\SourceCodeAccount;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RepositoryResource extends Resource
{
    protected static ?string $model = Repository::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('project_id')
                    ->relationship('project', 'name')
                    ->required()
                    ->live(),

                Select::make('source_code_account_id')
                     // TODO: after multitenancy implemented add the scope here
                    ->relationship('sourceCodeAccount', 'name', function (Builder $query, Get $get) {
                        $project = null;
                        if($get('project_id')){
                            $project = Project::query()->find($get('project_id'));
                        }

                        return $query->when($project, fn($query) => $query->where('team_id', $project->team_id));
                    })
                    ->getOptionLabelFromRecordUsing(fn (SourceCodeAccount $record) => "{$record->provider->getLabel()} - {$record->name} ")
                    ->searchable(['name', 'provider'])
                    ->preload()
                    ->label('Account')
                    ->live(),

                Section::make('Repository')
                    ->hidden(function (Get $get) {
                        if ($get('source_code_account_id') == null) {
                            return true;
                        }

                        return !$get('source_code_account_id');
                    })
                    ->schema([
                        // Github - Gitlab
                        Select::make('name')
                            ->placeholder('Account/Repository')
                            ->hidden(function (Get $get) {
                                $sourceCodeAccount = SourceCodeAccount::query()->find($get('source_code_account_id'));

                                return $sourceCodeAccount?->provider == SourceCodeProvider::Bitbucket;
                            })
                            ->options(function (Get $get) {
                                $sourceCodeAccount = SourceCodeAccount::query()->find($get('source_code_account_id'));

                                if(!$sourceCodeAccount){
                                    return [];
                                }

                                $repositories = collect($sourceCodeAccount->getProvider()->searchRepositories($sourceCodeAccount, ''))
                                    ->pluck('fullName', 'fullName')->toArray();

                                return $repositories;
                            })->required(),
                        // Bitbucket
                        Grid::make('bitbucket')
                            ->columns(2)
                            ->hidden(function (Get $get) {
                                $sourceCodeAccount = SourceCodeAccount::query()->find($get('source_code_account_id'));

                                return $sourceCodeAccount?->provider != SourceCodeProvider::Bitbucket;
                            })
                            ->schema([
                                Select::make('workspace')
                                    ->label('Workspace')
                                    ->options(function (Get $get) {
                                        $sourceCodeAccount = SourceCodeAccount::query()->find($get('source_code_account_id'));

                                        if(!$sourceCodeAccount){
                                            return [];
                                        }

                                        $workspaces = collect($sourceCodeAccount->getProvider()->searchWorkspaces($sourceCodeAccount, ''))
                                            ->mapWithKeys(function ($item) {
                                                return [$item => $item];
                                            })->toArray();

                                        return $workspaces;
                                    })
                                    ->afterStateUpdated(fn (Set $set) => $set('name', null))
                                    ->live()
                                    ->required(),
                                Select::make('name')
                                    ->label('Repository name')
                                    ->options(function (Get $get) {
                                        if (!$get('workspace')) {
                                            return [];
                                        }

                                        $sourceCodeAccount = SourceCodeAccount::query()->find($get('source_code_account_id'));

                                        if(!$sourceCodeAccount){
                                            return [];
                                        }

                                        $repositories = collect($sourceCodeAccount->getProvider()->searchRepositories($sourceCodeAccount, $get('workspace')))
                                            ->pluck('fullName', 'fullName')->toArray();

                                        return $repositories;
                                    })->required(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('project.name')
                    ->sortable()
                    ->searchable()
                    ->badge(),
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
            'index' => Pages\ListRepositories::route('/'),
            'create' => Pages\CreateRepository::route('/create'),
            'edit' => Pages\EditRepository::route('/{record}/edit'),
        ];
    }
}
