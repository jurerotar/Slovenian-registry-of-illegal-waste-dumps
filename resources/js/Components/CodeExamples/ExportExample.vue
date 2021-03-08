<template>
    <prism language="json">{{ code }}</prism>
</template>

<script>
import 'prismjs';
import 'prismjs/components/prism-json';
import Prism from 'vue-prism-component';

export default {
    name: "ExportExample",
    components: {
        Prism
    },
    data() {
        return {
            /**
             * Never ever ever reformat code property, because it breaks the output
             */
            code:
                `[
    {
        "id": 663,
        "title": "Vogr\u0161\u010dek",
        "description": "Deli avtomobila",
        "dangerous": false,
        "cleared": false,
        "urgent": false,
        "area": 10,
        "distance": 10,
        "estimated_volume": 6,
        "volume": "3-9m3 (velikost osebnega avtomobila)",
        "access": "Terensko vozilo",
        "terrain": null,
        "irsop": {
            "name": "Obmo\u010dna enota Nova Gorica",
            "address": "Trg Edvarda Kardelja 1, 5000, Nova Gorica",
            "email": "irsop.oe-ng@gov.si",
            "tel": "+38681814509"
        },
        "geodetic_information": {
            "region_id": 10,
            "region_name": "Gori\u0161ka",
            "municipality_id": 186,
            "municipality_name": "Ajdov\u0161\u010dina",
            "cadastral_municipality_id": 2384,
            "cadastral_municipality_name": "\u010crni\u010de",
            "portion": "946\\/225"
        },
        "coordinates": {
            "wgs84_longitude": 13.753874557,
            "wgs84_latitude": 45.903242081
        },
        "trash_types": {
            "organic_waste": 0,
            "construction_waste": 0,
            "municipal_waste": 0,
            "bulk_waste": 100,
            "hazardous_waste": 0,
            "tires": 0,
            "vehicles": 0,
            "asbestos_plates": 0,
            "hazardous_liquids": 0
        },
        "comments": []
    }
]
`
        }
    }
}
</script>
