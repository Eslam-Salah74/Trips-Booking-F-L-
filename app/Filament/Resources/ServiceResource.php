<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Service;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\ServiceResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ServiceResource\RelationManagers;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Wizard::make([
                        Wizard\Step::make(__('Title'))
                            ->schema([
                                TextInput::make('title')
                                    ->label(__('title'))
                                    ->required()
                                    ->unique('services', 'title', fn ($record) => $record),
                                TextInput::make('icon_class')
                                ->label(__('icon_class'))
                                ->required(),
                                MarkdownEditor::make('short_desc')
                                ->label(__('short_desc'))
                                ->required(),       
                        ]),
                        Wizard\Step::make(__('Title2'))
                        ->schema([
                            Repeater::make('description')
                                ->label('Description')
                                ->schema([
                                Select::make('type')
                                    ->label('Type')
                                    ->options([
                                        'title' => 'Title',
                                        'paragraph' => 'Paragraph',
                                        'step' => 'Step',
                                    ])
                                    ->required()
                                    ->reactive() // يجعل العنصر متفاعلًا ويحدثه فور تغيير القيمة
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('trigger', $state)), // يستخدم لتحديث القيم بعد تغييرها
                                    MarkdownEditor::make('content')
                                    ->label('Content')
                                    ->required()
                                    ->visible(fn ($get) => $get('type') !== 'step'),

                                    TextInput::make('step_title')
                                    ->label('Step Title')
                                    ->required()
                                    ->visible(fn ($get) => $get('type') === 'step'),

                                Repeater::make('list')
                                    ->label('Step List Items')
                                    ->schema([
                                        MarkdownEditor::make('list_item')
                                            ->label('List Item')
                                            ->required(),
                                    ])
                                    ->visible(fn ($get) => $get('type') === 'step'),
                            ])
                            ->collapsed(),

                            Toggle::make('statuse')
                                    ->label(__('statuse'))
                                    ->default(1)
                            ->nullable(),
                        ])
                    ])->skippable()
                ])    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                ->label(__('title'))
                ->searchable()
                ->sortable(),
                TextColumn::make('short_desc')
                    ->label(__('short_desc'))
                    ->searchable()
                    ->sortable()
                    ->limit(50)  // يحد من عدد الأحرف المعروضة إلى 50
                    ->html() // يسمح بتطبيق CSS لتنسيق النص
                    ->wrap() // يتأكد من أن النص سينتقل إلى الأسطر التالية إذا كان طويلاً
                    ->extraAttributes([
                        'style' => 'white-space: pre-wrap; word-wrap: break-word; max-width: 200px;', // يمكنك تعديل max-width حسب الحاجة
                    ]),
                    IconColumn::make('statuse')
                    ->label(__('statuse'))
                    ->boolean()
                    ->trueIcon('heroicon-s-check-circle')  // الأيقونة التي ستظهر إذا كانت القيمة true
                    ->falseIcon('heroicon-s-x-circle')     // الأيقونة التي ستظهر إذا كانت القيمة false
                    ->colors([
                        'success' => true, // لون الأيقونة للحالة true
                        'danger' => false, // لون الأيقونة للحالة false
                ])
                ->sortable(),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
