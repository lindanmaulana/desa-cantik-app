<?php

namespace App\Http\Controllers\Dashboard\Statistics;

use App\Exports\StatisticsAllExport;
use App\Exports\StatisticsExport;
use App\Http\Controllers\Controller;
use App\Models\VillageSetting;
use App\Services\Statistics\StatisticsExportService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StatisticsExportController extends Controller
{
    private const MODULES = ['demograph', 'social', 'health', 'economic', 'msme', 'infrastructure'];

    public function __construct(
        protected StatisticsExportService $exportService,
    ) {}

    public function excel(Request $request, string $module)
    {
        $this->validateModule($module);
        $report = $this->report($request, $module);

        return Excel::download(
            new StatisticsExport($report),
            $this->filename($module, 'xlsx')
        );
    }

    public function pdf(Request $request, string $module)
    {
        $this->validateModule($module);
        $report = $this->report($request, $module);

        $pdf = Pdf::loadView('dashboard.statistics.exports.report', [
            'reports' => [$report],
            'villageSetting' => VillageSetting::query()->first(),
            'rw' => $request->string('rw')->toString() ?: null,
            'rt' => $request->string('rt')->toString() ?: null,
        ])->setPaper('a4', 'portrait');

        return $pdf->download($this->filename($module, 'pdf'));
    }

    public function allExcel(Request $request)
    {
        $reports = $this->exportService->all(
            $request->string('rw')->toString() ?: null,
            $request->string('rt')->toString() ?: null,
        );

        return Excel::download(
            new StatisticsAllExport($reports),
            $this->filename('semua-statistik', 'xlsx')
        );
    }

    public function allPdf(Request $request)
    {
        $reports = $this->exportService->all(
            $request->string('rw')->toString() ?: null,
            $request->string('rt')->toString() ?: null,
        );

        $pdf = Pdf::loadView('dashboard.statistics.exports.report', [
            'reports' => $reports,
            'villageSetting' => VillageSetting::query()->first(),
            'rw' => $request->string('rw')->toString() ?: null,
            'rt' => $request->string('rt')->toString() ?: null,
        ])->setPaper('a4', 'portrait');

        return $pdf->download($this->filename('semua-statistik', 'pdf'));
    }

    private function report(Request $request, string $module): array
    {
        return $this->exportService->module(
            $module,
            $request->string('type')->toString() ?: null,
            $request->string('rw')->toString() ?: null,
            $request->string('rt')->toString() ?: null,
        );
    }

    private function validateModule(string $module): void
    {
        abort_unless(in_array($module, self::MODULES, true), 404);
    }

    private function filename(string $module, string $extension): string
    {
        $date = now()->format('Y-m-d');

        return "laporan-{$module}-{$date}.{$extension}";
    }
}
