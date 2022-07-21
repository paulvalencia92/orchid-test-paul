<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use App\Models\Reservation;
use App\Orchid\Layouts\Charts\ChartPie;
use Carbon\Carbon;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class PlatformScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'reservations' => $this->getNumberOfReservationByDate(),
            'charts' => [
                [
                    'name' => 'Some Data',
                    'values' => [25, 40, 30, 35, 8, 52, 17],
                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
                ],
                [
                    'name' => 'Another Set',
                    'values' => [25, 50, -10, 15, 18, 32, 27],
                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
                ],
                [
                    'name' => 'Yet Another',
                    'values' => [15, 20, -3, -15, 58, 12, -17],
                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
                ],
                [
                    'name' => 'And Last',
                    'values' => [10, 33, -8, -3, 70, 20, -34],
                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
                ],
            ],
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Get Started';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Welcome to your Orchid application.';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Website')
                ->href('http://orchid.software')
                ->icon('globe-alt'),

            Link::make('Documentation')
                ->href('https://orchid.software/en/docs')
                ->icon('docs'),

            Link::make('GitHub')
                ->href('https://github.com/orchidsoftware/platform')
                ->icon('social-github'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            ChartPie::class,
            Layout::view('bootstrap'),
            Layout::view('platform::partials.welcome'),
        ];
    }


    protected function getNumberOfReservationByDate(): iterable
    {
        $reservations = Reservation::query()->orderBy('from')->get();
        $data = $reservations->groupBy('from')
            ->map(function ($data, $from) {
                $date = Carbon::parse($from);
                $dateEs = sprintf('%s de %s de %s', $date->day, $date->monthName, $date->year);
                return [
                    'name' => $dateEs,
                    'values' => [count($data)],
                    'labels' => [count($data)],
                ];
            })->values();


        $values = collect();
        $labels = collect();

        foreach ($data as $i) {
            $values->push($i['values']);
            $labels->push($i['name']);
        }

        return [
            [
                'name' => 'Graficos',
                'values' => $values->toArray(),
                'labels' => $labels->toArray()
            ]
        ];

    }
}
