export function spatialData() {
    return {
        openCreate: false,
        openUpdate: false,
        spatial: {
            id: "",
            feature_type: "",
            feature_id: "",
            latitude: "",
            longtitude: "",
            geojson: "",
        },

        openModal(data) {
            this.spatial = {
                id: data.id,
                feature_type: data.feature_type || "",
                feature_id: data.feature_id || "",
                latitude: data.latitude || "",
                longtitude: data.longtitude || "",
                geojson: data.geojson ? JSON.stringify(data.geojson) : "",
            };
            this.openUpdate = true;
        },
    };
}

export function spatialDataCreate() {
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
