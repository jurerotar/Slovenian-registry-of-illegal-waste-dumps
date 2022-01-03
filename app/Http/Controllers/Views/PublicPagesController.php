<?php

namespace App\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Http\Resources\ViewProps\ExportViewDataResource;
use App\Http\Resources\ViewProps\InteractiveMapDataResource;
use App\Http\Resources\ViewProps\MunicipalityStatisticsDataResource;
use App\Models\Municipality;
use App\Models\Region;
use App\Services\ViewMetadataService;
use App\Services\ViewProps\ExportDataService;
use App\Services\ViewProps\InteractiveMapDataService;
use App\Services\ViewProps\MunicipalityStatisticsService;
use App\Services\ViewProps\StatisticsDataService;
use Inertia\Response;
use function inertia;

class PublicPagesController extends Controller
{
    public function home(): Response
    {
        return inertia('public/Home', [
            'meta' => (new ViewMetadataService())('public/Home'),
            'municipalityStatisticsData' => MunicipalityStatisticsDataResource::collection((new MunicipalityStatisticsService())()),
            'interactiveMapData' => InteractiveMapDataResource::collection((new InteractiveMapDataService())()),
            'statisticsData' => (new StatisticsDataService())(),
        ]);
    }

    public function map(): Response
    {
        return inertia('public/Map', [
            'meta' => (new ViewMetadataService())('public/Map'),
        ]);
    }

    public function export(): Response
    {
        return inertia('public/Export', [
            'meta' => (new ViewMetadataService())('public/Export'),
            'exports' => new ExportViewDataResource((new ExportDataService())())
        ]);
    }

    public function reportDump(): Response
    {
        return inertia('public/ReportDump', [
            'meta' => (new ViewMetadataService())('public/ReportDump'),
        ]);
    }

    public function region(Region $region): Response
    {
        return inertia('public/Region', [
            'meta' => (new ViewMetadataService())('public/Region', $region),
        ]);
    }

    public function municipality(Municipality $municipality): Response
    {
        return inertia('public/Municipality', [
            'meta' => (new ViewMetadataService())('public/Municipality', $municipality),
//            'dumps' =>
//                Dump::with([
//                    'accessType',
//                    'terrainType',
//                    'volumeEstimate:id',
//                    'geodeticInformation',
//                    'comments' => fn($q) => $q->with('user:id,name'),
//                    'comments:user_id,dump_id,content,updated_at'
//                ])
//                    ->whereRelation('municipality', 'id', $municipality->id)
//                    ->get()->toJson(),
        ]);
    }

    public function test()
    {
        dump(MunicipalityStatisticsDataResource::collection((new MunicipalityStatisticsService())()));
    }
}
