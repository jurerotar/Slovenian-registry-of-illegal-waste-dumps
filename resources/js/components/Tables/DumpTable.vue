<template>
  <div class="w-full overflow-x-scroll lg:overflow-x-auto">
    <div class="min-w-[800px] flex flex-col w-full">
      <dump-table-head />
    </div>
  </div>
  <div
    v-for="dump in filtered"
    :key="dump.id"
    class=""
  >
    <div class="flex flex-col w-full overflow-x-scroll lg:overflow-x-auto">
      <dump-table-row :data="dump" />
    </div>
    <div class="w-full">
      <dump-table-information
        :data="dump"
        :volumes="additional.volumes"
      />
    </div>
  </div>
</template>

<script>

import DumpTableHead from "@/js/components/Tables/DumpTableHead";
import DumpTableRow from "@/js/components/Tables/DumpTableRow";
import DumpTableInformation from "@/js/components/Tables/DumpTableInformation";

export default {
    name: "DumpTable",
    components: {
        DumpTableInformation,
        DumpTableRow,
        DumpTableHead
    },
    props: {
        data: {
            type: Object,
            required: true
        },
        additional: {
            type: Object,
            required: true
        },
    },
    computed: {
        filtered() {
            let dumps = this.data;
            if (!this.$store.state.dumpTables.showCleared) {
                dumps.filter(el => el.cleared === false);
            }
            if (!this.$store.state.dumpTables.showDangerous) {
                dumps.filter(el => el.dangerous === false)
            }
            if (this.hasCoordinates && this.$store.state.dumpTables.sortBy === 'distance') {
                dumps = dumps.map(el => {
                    el.distance = this.distance(el.location.lat, el.location.lon);
                    return el;
                })
                dumps.sort((a, b) => a.distance - b.distance);
            } else {
                dumps.sort((a, b) => a.date - b.date);
            }
            return dumps;
        },
        /**
         * Returns boolean based on coordinates being set
         * @returns {boolean}
         */
        hasCoordinates() {
            return this.$store.state.coordinates.latitude && this.$store.state.coordinates.longitude;
        },
        /**
         * Returns coordinates object from store
         * @returns {Object}
         */
        coordinates() {
            return this.$store.state.coordinates;
        }
    },
    methods: {
        /**
         * Calculates distance between 2 sets of geographical points in WGS 84 coordinate system
         * @param {number} dumpLatitude
         * @param {number} dumpLongitude
         * @returns {number} - distance or '/' if user has not shared their location
         */
        distance(dumpLatitude, dumpLongitude) {
            const userLatitude = this.coordinates.latitude;
            const userLongitude = this.coordinates.longitude;
            const factor = 0.017453292519943295; // Math.PI / 180
            const cos = Math.cos;
            const a = 0.5 - cos((userLatitude - dumpLatitude) * factor) / 2 +
                cos(dumpLatitude * factor) * cos(userLatitude * factor) *
                (1 - cos((userLongitude - dumpLongitude) * factor)) / 2;

            return Math.round(12742 * Math.asin(Math.sqrt(a)) * 100) / 100; // 2 * R; R = 6371 km
        },
    }
}
</script>
