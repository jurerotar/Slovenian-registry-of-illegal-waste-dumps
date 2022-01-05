import {useStore} from "vuex";
import {onBeforeUnmount, onMounted} from "vue";
import {State} from "@/js/stores/store";

// Formats date from unix timestamp to Slovenian locale
export const niceDate = (date: number): string => {
  return (new Date(date * 1000)).toLocaleDateString('sl-SI');
}

// Returns a human-readable file size
export const niceBytes = (bytes: number): string => {
  if (bytes <= 1) {
    return '1 B';
  }
  const units: string[] = ['B', 'kB', 'MB', 'GB'];

  const exponent: number = Math.min(Math.floor(Math.log(bytes) / Math.log(1000)), units.length - 1);
  const num: string = (bytes / Math.pow(1000, exponent)).toFixed(2);
  const unit: string = units[exponent];

  return `${num} ${unit}`;
}

export const boolToString = (bool: boolean): string => {
  return (bool) ? 'Da' : 'Ne';
}

// Capitalizes a string
export const capitalize = (string: string): string => {
  return string.toLowerCase().replace(/\w/, (firstLetter: string): string => firstLetter.toUpperCase());
}


// Sets resize event handlers
export const setResizeHandler = (): void => {
  const store = useStore<State>();
  // Updates store with current window width
  const setWidth = (): void => store.commit('setWidth', window.innerWidth);
  // Updates store with current window height
  const setHeight = (): void => store.commit('setHeight', window.innerHeight);
  onMounted((): void => {
    setWidth();
    setHeight();
    window.addEventListener('resize', (): void => {
      setWidth();
      setHeight();
    });
  });

  onBeforeUnmount((): void => {
    window.removeEventListener('resize', (): void => {
      setWidth();
      setHeight();
    });
  });
}
