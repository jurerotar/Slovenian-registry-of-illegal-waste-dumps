export interface Timestamps {
  created_at?: string;
  updated_at?: string;
}

export interface Region extends Timestamps {
  id?: number;
  name?: string;
  slug?: string;
  area?: number;
  population?: number;
  population_per_area?: number;
  municipalities?: Municipality[];
}

export interface Municipality extends Timestamps {
  id?: number;
  name?: string;
  slug?: string;
  area?: number;
  population?: number;
  population_per_area?: number;
  villages?: number;
  intermunicipality_inspectorate_id?: number;
  state_inspectorate_id?: number;
  forest_service_unit_id?: number;
  region_id?: number;
}

/**
 * Municipality attachments
 */

export interface Inspectorate extends Timestamps {
  id?: number;
  name?: string;
  address?: string | null;
  email?: string | null;
  tel?: string | null;
  url?: string | null;
  type?: string;
}

export interface CadastralMunicipality {
  id?: number;
  name?: string;
}

/**
 * Dump & dump attachments
 */

export interface Dump extends Timestamps {
  id?: number;
  title?: string;
  description?: string | null;
  cleared?: boolean;
  distance?: number;
  has_hazardous_liquids?: boolean;
  wgs_84_latitude?: string;
  wgs_84_longitude?: string;
  user_id?: number;
  volume_estimate_id?: number;
  area_estimate_id?: number;
  access_type_id?: number;
  terrain_type_id?: number;
  municipality_id?: number;
}

export interface DumpSplit extends Timestamps {
  dump_id?: number;
  organic_waste?: number;
  construction_waste?: number;
  municipal_waste?: number;
  bulk_waste?: number;
  tires?: number;
  vehicles?: number;
  asbestos_plates?: number;
  hazardous_waste?: number;
}

export interface GeodeticInformation {
  dump_id?: number;

}

export interface Comment extends Timestamps {
  dump_id?: number;

}

/**
 * User & user attachments
 */

export interface User extends Timestamps {
  id?: number;

}

/**
 * Reference tables
 */

export interface AccessType {
  id?: number;
  type?: string;
  description?: string;
}

export interface VolumeEstimate {
  id?: number;
  volume?: string;
  description?: string;
  average?: number;
}

export interface AreaEstimate {
  id?: number;
  area?: string;
  description?: string;
  average?: number;
}

export interface TerrainType {
  id?: number;
  type?: string;
  description?: string;
}


