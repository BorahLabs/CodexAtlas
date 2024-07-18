<?php

namespace App\Filament\Onboarding\Resources\ProjectResource\RelationManagers;

use App\Actions\InternalNotifications\LogUserPerformedAction;
use App\Actions\Platform\Repositories\StoreRepository;
use App\Enums\SourceCodeProvider;
use App\Models\Repository;
use App\Models\SourceCodeAccount;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class RepositoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'repositories';

    protected static ?string $icon = 'heroicon-o-document';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('source_code_account_id')
                    ->relationship('sourceCodeAccount', 'name', fn ($query) => $query->where('team_id', $this->getOwnerRecord()->team_id))
                    ->getOptionLabelFromRecordUsing(fn (SourceCodeAccount $record) => "{$record->provider->getLabel()} - {$record->name} ")
                    ->searchable(['name', 'provider'])
                    ->preload()
                    ->label('Account')
                    ->live()
                    ->columnSpanFull(),

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

                                return $sourceCodeAccount->provider == SourceCodeProvider::Bitbucket;
                            })
                            ->options(function (Get $get) {
                                $sourceCodeAccount = SourceCodeAccount::query()->find($get('source_code_account_id'));

                                $repositories = collect($sourceCodeAccount->getProvider()->searchRepositories($sourceCodeAccount, ''))
                                    ->pluck('fullName', 'fullName')->toArray();

                                return $repositories;
                            })->required(),
                        // Bitbucket
                        Grid::make('bitbucket')
                            ->columns(2)
                            ->hidden(function (Get $get) {
                                $sourceCodeAccount = SourceCodeAccount::query()->find($get('source_code_account_id'));

                                return $sourceCodeAccount->provider != SourceCodeProvider::Bitbucket;
                            })
                            ->schema([
                                Select::make('workspace')
                                    ->label('Workspace')
                                    ->options(function (Get $get) {
                                        $sourceCodeAccount = SourceCodeAccount::query()->find($get('source_code_account_id'));

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

                                        $repositories = collect($sourceCodeAccount->getProvider()->searchRepositories($sourceCodeAccount, $get('workspace')))
                                            ->pluck('fullName', 'fullName')->toArray();

                                        return $repositories;
                                    })->required(),
                            ]),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('branches.name')
                    ->label('Branches')
                    ->badge(),
                TextColumn::make('branches_count')
                    ->label('Branches')
                    ->counts('branches')
                    ->icon('icon-branch')
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->using(function (array $data, string $model) {
                        $repoFullName = isset($data['workspace'])
                            ? $data['workspace'] . '/' . $data['name']
                            : $data['name'];

                        $repo = StoreRepository::make()->handle($this->getOwnerRecord(), $data['source_code_account_id'], $repoFullName);

                        LogUserPerformedAction::dispatch(\App\Enums\Platform::Codex, \App\Enums\NotificationType::Success, 'User added repository from onboarding panel ' . $repoFullName, [
                            'project' => $this->getOwnerRecord()->id,
                        ]);

                        return $repo;
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('')
                    ->mutateRecordDataUsing(function (array $data, Repository $record) {
                        $data['name'] = $data['username'] . '/' . $data['name'];
                        return $data;
                    }),
                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->requiresConfirmation()
                    ->modalDescription(function(Repository $record){
                        return new HtmlString('Are you sure you would like to do this? <br> This process will delete all data related to this repository. Write <strong>' . $record->name . '</strong> to confirm.');
                    })
                    ->form([
                        TextInput::make('name')
                            ->label('Repository name')
                            ->required(),
                    ])
                    ->action(function (array $data, Repository $record) {
                        if($data['name'] != $record->name){
                            $this->halt();
                        }

                        $record->branches()->delete();

                        $status = $record->delete();
                        if($status){
                            Notification::make()
                                ->title('Repository deleted successfully!')
                                ->success()
                                ->send();
                        } else{
                            Notification::make()
                            ->title('Error! Repository could not be deleted')
                            ->danger()
                            ->send();
                        }
                    }),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
