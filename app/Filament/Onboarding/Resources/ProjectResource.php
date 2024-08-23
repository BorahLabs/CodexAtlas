<?php

namespace App\Filament\Onboarding\Resources;

use App\Actions\Onboarding\GenerateProjectDescriptionFromUrl;
use App\Enums\SoRequirementType;
use App\Filament\Onboarding\Resources\ProjectResource\Pages;
use App\Filament\Onboarding\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Repository;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms;
use Filament\Forms\Components\Builder as ComponentsBuilder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
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
                                ->disabled(fn(Get $get) => ! filter_var($get('public_url'), FILTER_VALIDATE_URL))
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

    private static function getDevOsRequirementBlocks(): array
    {
        $devSoRequirementBlocks = [];

        collect(SoRequirementType::cases())->each(function ($so) use (&$devSoRequirementBlocks) {
            $block =
                Block::make($so->getLabel())
                ->schema([
                    Repeater::make('requirements')
                        ->grid(2)
                        ->schema([
                            TextInput::make('title')
                                ->label('Title')
                                ->required(),
                            TextInput::make('description')
                                ->label('Description')
                                ->required(),
                            Repeater::make('links')
                                ->simple(TextInput::make('url')->url()),
                        ]),
                ])
                ->icon($so->getIcon())
                ->columns(1);

            array_push($devSoRequirementBlocks, $block);
        });

        return $devSoRequirementBlocks;
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
                            ->icon(fn(Get $get) => $get('concepts') ? 'heroicon-o-check-circle' : 'heroicon-o-clock')
                            ->iconColor(fn(Get $get) => $get('concepts') ? 'success' : 'gray')
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
                            ->icon(fn(Get $get) => $get('relevant_links') ? 'heroicon-o-check-circle' : 'heroicon-o-clock')
                            ->iconColor(fn(Get $get) => $get('relevant_links') ? 'success' : 'gray')
                            ->collapsible(true)
                            ->collapsed(true),
                    ]),
                Forms\Components\Wizard\Step::make('Dev environment')
                    ->schema([
                        ComponentsBuilder::make('os_requirements')
                            ->label('OS Requirements')
                            ->addActionLabel('Add OS')
                            ->blocks(self::getDevOsRequirementBlocks()),
                    ]),
                Forms\Components\Wizard\Step::make('Repository environment')
                    ->schema([
                        Repeater::make('repositories')
                            ->relationship()
                            ->itemLabel(fn(array $state): ?string => $state['repository_name'] ?? null)
                            ->collapsible()
                            ->schema([
                                Section::make('Repo information')
                                    ->collapsible()
                                    ->icon('heroicon-o-information-circle')
                                    ->schema([
                                        Select::make('source_code_account_id')
                                            ->relationship('sourceCodeAccount', 'name')
                                            ->preload()
                                            ->required()
                                            ->getOptionLabelFromRecordUsing(fn(SourceCodeAccount $record) => "{$record->provider->getLabel()} - {$record->name}")
                                            ->live(),

                                        Select::make('repository_name')
                                            ->required()
                                            ->options(function (Get $get) {
                                                if ($get('source_code_account_id') == null) {
                                                    return [];
                                                }

                                                $account = SourceCodeAccount::query()->find($get('source_code_account_id'));

                                                $provider = $account->getProvider();
                                                $repositories = cache()->remember('repository-list:' . $account->id, now()->addMinutes(5), fn() => $provider->repositories());
                                                usort($repositories, fn(Repository $a, Repository $b) => $a->fullName <=> $b->fullName);

                                                $repos = [];

                                                collect($repositories)->each(function ($item) use (&$repos) {
                                                    $repos[$item->fullName] = $item->fullName;
                                                });

                                                return $repos;
                                            }),
                                    ]),

                                Section::make('Instructions')
                                    ->icon('heroicon-o-list-bullet')
                                    ->collapsible()
                                    ->schema([
                                        Repeater::make('instructions')
                                            ->label('Instructions')
                                            ->relationship('repositoryInstructions')
                                            ->grid(2)
                                            ->schema([
                                                TextInput::make('title')
                                                    ->label('Title')
                                                    ->required(),
                                                TextInput::make('description')
                                                    ->label('Description')
                                                    ->required(),
                                                Repeater::make('links')
                                                    ->simple(TextInput::make('url')->url()),
                                            ])
                                            ->collapsible()
                                            ->itemLabel(fn(array $state): ?string => $state['title'] ?? null),
                                    ]),

                            ])
                            ->mutateRelationshipDataBeforeFillUsing(function (array $data): array{
                                $data['repository_name'] = $data['username'] . '/' . $data['name'];

                                return $data;
                            })
                            ->mutateRelationshipDataBeforeCreateUsing(function (array $data): array {
                                $data = self::modifyRepositoryDataBeforeSaving($data);

                                if(!$data){
                                    $this->halt();
                                }

                                return $data;
                            })
                            ->mutateRelationshipDataBeforeSaveUsing(function (array $data): array {
                                $data = self::modifyRepositoryDataBeforeSaving($data);

                                if(!$data){
                                    $this->halt();
                                }

                                return $data;
                            })
                            ->columns(2),
                    ]),
            ]),
        ];
    }

    private static function modifyRepositoryDataBeforeSaving(array $data): array
    {
        $account = SourceCodeAccount::query()->find($data['source_code_account_id']);

        if ($account->provider->isBitbucket()) {
            $repo = collect($account->provider->repositories())->where('fullName', $data['repository_name'])->first();

            if (!$repo) {
                Notification::make()
                    ->danger()
                    ->title('Error while finding Bitbucket repository data')
                    ->send();
                return null;
            }

            $data['username'] = $repo->owner;
            $data['name'] = $repo->name;
            $data['workspace'] = $repo->workspace;
        } else {
            $parts = explode('/', $data['repository_name']);

            $data['username'] = $parts[0];
            $data['name'] = $parts[1];
        }
        unset($data['repository_name']);

        return $data;
    }
}
