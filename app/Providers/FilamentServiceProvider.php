<?php

namespace App\Providers;

use App\Filament\Resources\CategoryResource;
use App\Filament\Resources\ProductResource;
use App\Filament\Resources\OrderResource;
use App\Filament\Resources\UserResource;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Filament::serving(function () {
            Filament::navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder
                    ->groups([
                        // Catalog Management Group
                        NavigationGroup::make('Catalog')
                            ->icon('heroicon-o-shopping-bag')
                            ->items([
                                NavigationItem::make('Categories')
                                    ->icon('heroicon-o-collection')
                                    ->isActiveWhen(fn (): bool => request()->routeIs('filament.resources.categories.*'))
                                    ->url(CategoryResource::getUrl()),
                                NavigationItem::make('Products')
                                    ->icon('heroicon-o-cube')
                                    ->isActiveWhen(fn (): bool => request()->routeIs('filament.resources.products.*'))
                                    ->url(ProductResource::getUrl()),
                            ]),

                        // Sales Management Group
                        NavigationGroup::make('Sales')
                            ->icon('heroicon-o-currency-dollar')
                            ->items([
                                NavigationItem::make('Orders')
                                    ->icon('heroicon-o-shopping-cart')
                                    ->isActiveWhen(fn (): bool => request()->routeIs('filament.resources.orders.*'))
                                    ->url(OrderResource::getUrl()),
                            ]),

                        // Website Content Group
                        NavigationGroup::make('Website')
                            ->icon('heroicon-o-globe')
                            ->items([
                                NavigationItem::make('View Website')
                                    ->icon('heroicon-o-eye')
                                    ->url('/')
                                    ->openUrlInNewTab(),
                                NavigationItem::make('WhatsApp Settings')
                                    ->icon('heroicon-o-chat-bubble-left-ellipsis') // Changed from heroicon-o-chat
                                    ->url(route('filament.pages.whatsapp-settings')),
                            ]),

                        // System Settings Group
                        NavigationGroup::make('Settings')
                            ->icon('heroicon-o-cog-6-tooth') // Updated from heroicon-o-cog
                            ->items([
                                NavigationItem::make('Users')
                                    ->icon('heroicon-o-users')
                                    ->isActiveWhen(fn (): bool => request()->routeIs('filament.resources.users.*'))
                                    ->url(UserResource::getUrl()),
                                NavigationItem::make('General Settings')
                                    ->icon('heroicon-o-adjustments-horizontal') // Updated from heroicon-o-adjustments
                                    ->url(route('filament.pages.settings')),
                            ]),
                    ]);
            });
        });
    }
}
