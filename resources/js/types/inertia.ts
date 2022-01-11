import {PageProps} from "@inertiajs/inertia";

// Union of shared and page-specific props
export interface InertiaPageProps extends PageProps,
  InertiaSharedProps,
  HomePageProps,
  MapPageProps,
  ExportPageProps,
  ReportDumpPageProps {
}

// Shared page props
export interface InertiaSharedProps {
  meta: Meta;
}

export interface Meta {
  title: string,
  description: string
}

// Home page props
export interface HomePageProps {
  interactiveMapData: InteractiveMapData[];
  statisticsData: StatisticsData[];
}

export interface InteractiveMapData {
  id: number;
  name: string;
  slug: string;
  area: number;
  cleared: number;
  population: number;
  uncleared: number;
  total: number;
}

export interface StatisticsData {

}

// Map page props
export interface MapPageProps {

}

// Export page props
export interface ExportPageProps {
  exports: RegionExportData[];
}

export interface RegionExportData {
  id: number;
  name: string;
  slug: string;
  dump_count: number;
  municipalities: MunicipalityExportData[];
  updated_at: number;
}

export interface MunicipalityExportData {
  id: number;
  name: string;
  slug: string;
  dump_count: number;
  updated_at: number;
}

// Report dump page props
export interface ReportDumpPageProps {

}


