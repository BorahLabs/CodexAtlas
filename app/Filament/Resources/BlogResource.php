<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Filament\Resources\BlogResource\RelationManagers;
use App\Models\Blog;
use Carbon\Carbon;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->columnSpan(fn ($context) => $context == 'create' ? 1 : 'full'),
                TextInput::make('slug')
                    ->disabled()
                    ->hiddenOn(['create']),
                DateTimePicker::make('published_at')
                    ->native(false)
                    ->required(),
                FileUpload::make('image')
                    ->image()
                    ->required()
                    ->columnSpanFull()
                    ->disk('public'),
                TextInput::make('image_alt')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('excerpt')
                    ->required()
                    ->columnSpanFull(),
                MarkdownEditor::make('markdown_content')
                    ->required()
                    ->columnSpanFull()
                    ->fileAttachmentsDisk('public'),
                Select::make('related_blogs')
                    ->multiple()
                    ->preload()
                    ->columnSpanFull()
                    ->options(function($context, $record){
                        $query = Blog::query();
                        return $context == 'edit' ? $query->where('id', '!=', $record->id)->get()->pluck('title', 'id') : $query->get()->pluck('title', 'id');
                    }),
                TextInput::make('seo_title')
                    ->required(),
                TextInput::make('seo_description')
                    ->required(),
                Toggle::make('is_active'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->sortable()
                    ->searchable()
                    ->limit(50),
                TextColumn::make('published_at')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->format('H:i d-m-Y'))
                    ->badge()
                    ->color(fn($state) => $state <= now() ? 'success' : 'danger'),
                TextColumn::make('created_at')
                    ->label('Related blogs')
                    ->badge()
                    ->icon('heroicon-o-clipboard')
                    ->color('danger')
                    ->formatStateUsing(fn($record) => count($record->related_blogs)),
                IconColumn::make('is_active')
                    ->boolean(),

            ])
            ->filters([
                Filter::make('filters')
                    ->form([
                        Select::make('is_active')
                            ->options([
                                'all' => 'All',
                                'active' => 'Active',
                                'inactive' => 'Inactive'
                            ]),
                        Select::make('published')
                            ->options([
                                'all' => 'All',
                                'published' => 'Published',
                                'unpublished' => 'Unpublished'
                            ]),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['is_active'],
                                function (Builder $query, $value): Builder {
                                    switch($value){
                                        case 'active':
                                            return $query->where('is_active', true);
                                        case 'inactive':
                                            return $query->where('is_active', false);
                                        default:
                                            return $query;
                                    }
                                }
                            )
                            ->when(
                                $data['published'],
                                function (Builder $query, $value): Builder {

                                    switch($value){
                                        case 'published':
                                            return $query->whereDate('published_at', '<=', now());
                                        case 'unpublished':
                                            return $query->whereDate('published_at', '>', now());
                                        default:
                                            return $query;
                                    }
                                }
                            );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
