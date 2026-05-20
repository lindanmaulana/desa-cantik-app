export function infrastructureData() {
    return {
        openData: false,
        openCreate: false,
        openUpdate: false,
        infrastructure: {
            id: "",
            facility_name: "",
            facility_type: "",
            condition: "",
            construction_year: "",
            funding_source: "",
        },

        openModal(data) {
            this.infrastructure = {
                id: data.id,
                facility_name: data.facility_name || "",
                facility_type: data.facility_type || "",
                condition: data.condition || "",
                construction_year: data.construction_year || "",
                funding_source: data.funding_source || "",
            };
            this.openUpdate = true;
        },
    };
}
