<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms\Components\Card;
use Filament\Notifications\Notification;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $title = 'General Settings';
    protected static ?string $slug = 'settings';
    protected static string $view = 'filament.pages.settings';
    
    public $site_name;
    public $site_description;
    public $maintenance_mode;
    
    public function form(Form $form): Form
    {
        return $form->schema([
            Card::make()
                ->schema([
                    Forms\Components\TextInput::make('site_name')
                        ->label('Site Name')
                        ->required(),
                        
                    Forms\Components\Textarea::make('site_description')
                        ->label('Site Description')
                        ->rows(3),
                        
                    Forms\Components\Toggle::make('maintenance_mode')
                        ->label('Maintenance Mode')
                        ->helperText('When enabled, the site will show a maintenance page to visitors'),
                ])->columns(1)
        ]);
    }
    
    public function mount(): void
    {
        $this->site_name = settings('site_name', config('app.name'));
        $this->site_description = settings('site_description', '');
        $this->maintenance_mode = settings('maintenance_mode', false);
    }
    
    public function save(): void
    {
        settings([
            'site_name' => $this->site_name,
            'site_description' => $this->site_description,
            'maintenance_mode' => $this->maintenance_mode,
        ]);
        
        Notification::make()
            ->title('Settings saved successfully')
            ->success()
            ->send();
    }
}
