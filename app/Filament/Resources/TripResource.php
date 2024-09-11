<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Trip;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\TripResource\Pages;

class TripResource extends Resource
{
    protected static ?string $model = Trip::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-airplane';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Wizard::make([
                    Wizard\Step::make(__('General Data'))
                        ->schema([
                            TextInput::make('tripname')
                                ->label('Trip Name')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('subdescription')
                            ->label('subdescription')
                            ->required()
                            ->maxLength(255),
                                
                            FileUpload::make('featured_img')
                                ->label(__('Imfeatured_imgage'))
                                ->image()
                                ->maxSize(2048)
                                ->required()
                                ->rules(['mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'])
                                ->directory('featured_img'),
    
                            Select::make('city_id')
                                ->label('City')
                                ->relationship('city', 'name')
                                ->required()
                                ->searchable(),
    
                            Select::make('category_id')
                                ->label('Category')
                                ->relationship('category', 'name')
                                ->required()
                                ->searchable(),
    
                            TextInput::make('price')
                                ->label('Price')
                                ->numeric()
                                ->required(),
                        ]),
    
                    Wizard\Step::make(__('Gallery'))
                        ->schema([
                            FileUpload::make('img_gallery')
                                ->label(__('Image Gallery'))
                                ->image()
                                ->maxSize(2048)
                                ->multiple()
                                ->nullable()
                                ->helperText('Upload multiple images for the gallery.')
                                ->rules(['mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'])
                                ->directory('tripimg'),
                        ]),
    
                    Wizard\Step::make(__('Details and Pricing'))
                        ->schema([
                            Repeater::make('description')
                                ->label('Description')
                                ->schema([
                                    Select::make('type')
                                        ->label('Type')
                                        ->options([
                                            'title' => 'Title',
                                            'paragraph' => 'Paragraph',
                                            'list' => 'List',
                                            'timeline' => 'Timeline',
                                        ])
                                        ->required()
                                        ->reactive()
                                        ->afterStateUpdated(fn($state, callable $set) => $set('trigger', $state)),
    
                                    TextInput::make('title')
                                        ->label('Title')
                                        ->required(fn($get) => $get('type') === 'title') // Use `required` with condition
                                        ->visible(fn($get) => $get('type') === 'title'),
    
                                    MarkdownEditor::make('paragraph')
                                        ->label('Paragraph')
                                        ->required(fn($get) => $get('type') === 'paragraph') // Use `required` with condition
                                        ->visible(fn($get) => $get('type') === 'paragraph'),
    
                                    TextInput::make('list_title')
                                        ->label('List Title')
                                        ->required(fn($get) => $get('type') === 'list') // Use `required` with condition
                                        ->visible(fn($get) => $get('type') === 'list'),
    
                                    Repeater::make('list')
                                        ->label('Step List Items')
                                        ->schema([
                                            MarkdownEditor::make('list_item')
                                                ->label('List Item')
                                                ->required(),
                                        ])
                                        ->visible(fn($get) => $get('type') === 'list'),
    
                                    TextInput::make('timeline_title')
                                        ->label('Timeline Title')
                                        ->required(fn($get) => $get('type') === 'timeline') // Use `required` with condition
                                        ->visible(fn($get) => $get('type') === 'timeline'),
    
                                    TextInput::make('timeline_subtitle')
                                        ->label('Timeline Subtitle')
                                        ->required(fn($get) => $get('type') === 'timeline') // Use `required` with condition
                                        ->visible(fn($get) => $get('type') === 'timeline'),
    
                                    Repeater::make('timeline_list')
                                        ->label('Timeline List Items')
                                        ->schema([
                                            Repeater::make('nested_items')
                                                ->label('Nested Items')
                                                ->schema([
                                                    MarkdownEditor::make('nested_item_content')
                                                        ->label('Nested Item Content')
                                                        ->required(),
                                                ]),
                                        ])
                                        ->visible(fn($get) => $get('type') === 'timeline'),
                                ]),
                        ]),
                    
                                Wizard\Step::make(__('Schadule Tipes'))
                                        ->schema([
                                            MarkdownEditor::make('FlightSchedules')
                                            ->label('FlightSchedules')
                                        ])
            ])->skippable(),
        ]),
        ]);
    }
    
    
    
    


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tripname')
                    ->label('Trip Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\ImageColumn::make('featured_img')
                    ->label('Featured Image'),

                Tables\Columns\TextColumn::make('city.name')
                    ->label('City')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->sortable(),
            ])
            ->filters([])
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrips::route('/'),
            'create' => Pages\CreateTrip::route('/create'),
            'edit' => Pages\EditTrip::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
