<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Candidat;
use App\Models\Course;
use App\Models\Session;
use App\Models\Payment;
use App\Models\Subvention;
use App\Models\CategorieModel;
use App\Models\Instructor;
use App\Models\Registration;
use App\Models\Source;
use Illuminate\Support\Facades\DB;
use Filament\Support\Enums\IconPosition;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Récupérer les paiements par jour
        $paymentsByDay = DB::table('candidats')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(amont) as total_amount'))
            ->groupBy('date')
            ->get();

        // Récupérer les paiements par semaine
        $paymentsByWeek = DB::table('candidats')
            ->select(DB::raw('YEAR(created_at) as year, WEEK(created_at) as week'), DB::raw('SUM(amont) as total_amount'))
            ->groupBy('year', 'week')
            ->get();

        // Récupérer les paiements par mois
        $paymentsByMonth = DB::table('candidats')
            ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month'), DB::raw('SUM(amont) as total_amount'))
            ->groupBy('year', 'month')
            ->get();

        // Récupérer les paiements par année
        $paymentsByYear = DB::table('candidats')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('SUM(amont) as total_amount'))
            ->groupBy('year')
            ->get();

        // Calculer les totaux pour chaque période
        $totalPaymentsByDay = $paymentsByDay->sum('total_amount');
        $totalPaymentsByWeek = $paymentsByWeek->sum('total_amount');
        $totalPaymentsByMonth = $paymentsByMonth->sum('total_amount');
        $totalPaymentsByYear = $paymentsByYear->sum('total_amount');

        // Construction des statistiques à afficher dans le widget
        return [
            Stat::make('Total Candidates', Candidat::count())->descriptionIcon('heroicon-m-arrow-trending-up', IconPosition::Before)
            ->color('success'),
            Stat::make('Total Courses', Course::count()),
            Stat::make('Total Sessions', Session::count()),
            Stat::make('Total Subventions', Subvention::count()),
            Stat::make('Total Categories', CategorieModel::count()),
            Stat::make('Total Instructors', Instructor::count()),
            Stat::make('Total Registrations', Registration::count()),
            Stat::make('Total Sources', Source::count()),
            Stat::make('Total Payments by Day', $totalPaymentsByDay),
            Stat::make('Total Payments by Week', $totalPaymentsByWeek),
            Stat::make('Total Payments by Month', $totalPaymentsByMonth),
            Stat::make('Total Payments by Year', $totalPaymentsByYear),
        ];
    }
}