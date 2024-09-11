<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Aboutus;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Wizard;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\AboutusResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AboutusResource\RelationManagers;

class AboutusResource extends Resource
{
    protected static ?string $model = Aboutus::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Card::make()->schema([
                Wizard::make([
                    Wizard\Step::make(__('content'))
                        ->schema([
                            TextInput::make('title')
                                ->label(__('title'))
                                ->required(),
                            MarkdownEditor::make('content')
                            ->label(__('content'))
                            ->required(),     
                        ]) ,
                        Wizard\Step::make(__('media'))
                        ->schema([
                            FileUpload::make('img')
                                ->label(__('img'))
                                ->image()
                                ->maxSize(2048)
                                ->required()
                                ->rules(['mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'])
                                ->directory('imgabout'),   
                        ]) 
                ])->skippable()
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('title')
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('img')
                    ->label(__('img')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    EditAction::make(),
                    ViewAction::make(),
                    DeleteAction::make(),
                ])
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
            'index' => Pages\ListAboutuses::route('/'),
            'create' => Pages\CreateAboutus::route('/create'),
            'edit' => Pages\EditAboutus::route('/{record}/edit'),
        ];
    }

    //  لاخفاء زرار الاضافة بعد اضافه اول صف فى الداتا بيز
    public static function canCreate(): bool
    {
        return Aboutus::count() === 0;
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
