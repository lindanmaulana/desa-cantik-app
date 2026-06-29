import Alpine from "alpinejs";

function spatialData() {
    return {
        openCreate: false,
        openUpdate: false,
        openDelete: false,   // 1. Definisikan state visibilitas modal hapus
        deleteRoute: '',     // 2. Definisikan wadah rute penghapusan

        spatial: {
            id: "",
            feature_type: "",
            feature_id: "",
            latitude: "",
            longitude: "",
            geojson: "",
        },

        // 3. Daftarkan fungsi pemicu modal hapus yang dipanggil oleh tombol di tabel Anda
        openDeleteModal(event) {
            // Ambil URL rute dari attribute data-url button yang di-klik
            const button = event.currentTarget;
            this.deleteRoute = button.getAttribute('data-url');
            this.openDelete = true;
        },

        openModal(data) {
            this.spatial = {
                id: data.id,
                feature_type: data.feature_type || "",
                feature_id: data.feature_id || "",
                latitude: data.latitude || "",
                longitude: data.longitude || "",
                geojson: data.geojson ? JSON.stringify(data.geojson) : "",
            };
            this.openUpdate = true;
        },
    };
}

function spatialDataCreate() {
    return {
        featureType: "",
        featureId: "",

        init() {
            this.$watch("featureType", (value) => {
                if (value === "village_boundary") {
                    this.featureId = "00000000-0000-0000-0000-000000000000";
                } else {
                    this.featureId = "";
                }
            });
        },
    };
}

export default function initSpatialModule() {
    Alpine.data("spatialData", spatialData);
    Alpine.data("spatialDataCreate", spatialDataCreate);
}
