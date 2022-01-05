export interface AppState {
  currentUrl: string | null;
  sidebarExtended: boolean;
  interactiveMapSelectedRegion: string;
  agreements: Agreements;
  userPreferences: UserPreferences;
}

export interface UserPreferences {
  preferences: Preferences;
}

export interface Preferences extends PreferenceTypes {
  darkThemeEnabled: boolean;
  accessibilityEnabled: boolean;
  reducedMotionEnabled: boolean;
  highContrastEnabled: boolean;
}

export interface Agreements {
  dataExport: boolean;
}

interface PreferenceTypes {
  [preferenceType: string]: boolean;
}
