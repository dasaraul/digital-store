<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Pages\Page;
use Filament\Forms\Components\Card;
use Filament\Notifications\Notification;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth'; // Updated icon
    protected static ?string $title = 'General Settings';
    protected static ?string $slug = 'settings';
    
    public $site_name;
    public $site_description;
    public $maintenance_mode;
    
    protected function getFormSchema(): array
    {
        return [
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
                ])
        ];
    }
    
    public function mount(): void
    {
        $this->site_name = settings('site_name', config('app.name'));
        $this->site_description = settings('site_description', '');
        $this->maintenance_mode = settings('maintenance_mode', false);
    }
    
    public function submit(): void
    {
        settings(['site_name' => $this->site_name]);
        settings(['site_description' => $this->site_description]);
        settings(['maintenance_mode' => $this->maintenance_mode]);
        
        Notification::make()
            ->title('Settings saved successfully')
            ->success()
            ->send();
    }
}