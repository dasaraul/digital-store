<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Orders', Order::count())
                ->description('Total orders in the system')
                ->descriptionIcon('heroicon-s-shopping-cart')
                ->color('primary'),
            
            Card::make('Pending Orders', Order::where('status', 'pending')->count())
                ->description('Orders waiting to be processed')
                ->descriptionIcon('heroicon-s-clock')
                ->color('warning'),
            
            Card::make('Out of Stock Products', Product::where('stock', 0)->count())
                ->description('Products that need restocking')
                ->descriptionIcon('heroicon-s-exclamation')
                ->color('danger'),
            
            Card::make('Total Revenue', 'Rp ' . number_format(Order::sum('total_amount'), 0, ',', '.'))
                ->description('Total sales revenue')
                ->descriptionIcon('heroicon-s-currency-dollar')
                ->color('success'),
        ];
    }
}
