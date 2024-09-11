<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Member;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\MemberResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MemberResource\RelationManagers;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Wizard::make([
                        Wizard\Step::make(__('informations'))
                            ->schema([
                                TextInput::make('name')
                                    ->label(__('name'))
                                    ->required(),
                                TextInput::make('joptitle')
                                ->label(__('joptitle'))
                                ->required(), 
                                FileUpload::make('img')
                                ->label(__('img'))
                                ->image() // تحقق أن الملف صورة
                                ->maxSize(2048) // الحجم الأقصى للملف 2 ميجابايت
                                ->required() // اجعل الحقل مطلوبًا إذا كان ضروريًا
                                ->rules(['mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048']) // قواعد التحقق الإضافية
                                ->directory('imgtem'),     
                            ]) ,
                            Wizard\Step::make(__('socialmedia'))
                            ->schema([
                                Repeater::make('socialmedia')
                                ->label('socialmedia')
                                ->schema([
                                    TextInput::make('key')
                                        ->label('Title')
                                        ->required(),
                                        TextInput::make('url')
                                        ->label('Website URL')
                                        ->required() // اجعل الحقل إلزامي
                                        ->url() // تأكد من أن الإدخال هو عنوان URL صالح
                                        ->placeholder('https://example.com') // نص توضيحي
                                ])
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
                TextColumn::make('name')
                ->label(__('title'))
                ->searchable()
                ->sortable(),
                TextColumn::make('joptitle')
                ->label(__('joptitle'))
                ->searchable()
                ->sortable(),
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
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
