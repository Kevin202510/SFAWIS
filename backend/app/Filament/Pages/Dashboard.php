<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Pages\Page;
use Filament\Tables\Concerns\HasFilters;

class Dashboard extends \Filament\Pages\Dashboard
{
    use HasFiltersForm;

    public function filtersForm(Form $form): Form
    {
        return $form->schema(
            [
                Section::make("")->schema(
                    [
                        DatePicker::make('startDate'),
                        DatePicker::make('endDate'),
                    ]
                )->columns(2)
            ]
        );
    }
}
