<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms\Components\Card;
use Filament\Notifications\Notification;

class WhatsAppSettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';
    protected static ?string $title = 'WhatsApp Settings';
    protected static ?string $slug = 'whatsapp-settings';
    protected static string $view = 'filament.pages.whatsapp-settings';
    
    public $whatsapp_number;
    public $default_message;
    public $business_hours;
    
    public function form(Form $form): Form
    {
        return $form->schema([
            Card::make()
                ->schema([
                    Forms\Components\TextInput::make('whatsapp_number')
                        ->label('WhatsApp Number')
                        ->required()
                        ->placeholder('Example: 6282210819939'),
                    
                    Forms\Components\Textarea::make('default_message')
                        ->label('Default Message Template')
                        ->placeholder('Hi, I would like to inquire about...')
                        ->helperText('Use {product} for product name and {price} for product price'),
                        
                    Forms\Components\Textarea::make('business_hours')
                        ->label('Business Hours')
                        ->placeholder('Monday - Friday: 9 AM - 6 PM...')
                ])->columns(1)
        ]);
    }
    
    public function mount(): void
    {
        $this->whatsapp_number = settings('whatsapp_number', '082210819939');
        $this->default_message = settings('whatsapp_default_message', 'Hi, I would like to inquire about {product} (Rp {price})');
        $this->business_hours = settings('business_hours', 'Monday - Friday: 9 AM - 6 PM\nSaturday: 9 AM - 3 PM\nSunday: Closed');
    }
    
    public function save(): void
    {
        settings([
            'whatsapp_number' => $this->whatsapp_number,
            'whatsapp_default_message' => $this->default_message,
            'business_hours' => $this->business_hours,
        ]);
        
        Notification::make()
            ->title('Settings saved successfully')
            ->success()
            ->send();
    }
}
