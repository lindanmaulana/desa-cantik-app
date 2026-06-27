export function familyData() {
    return {
        openData: false,
        openCreate: false,
        openUpdate: false,
        openDelete: false,
        submitting: false,

        family: {
            id: "",
            territory_id: "",
            family_card_number: "",
            address_detail: "",
        },

        openModal(data) {
            this.family = {
                id: data.id,
                territory_id: data.territory_id || "",
                family_card_number: data.family_card_number,
                address_detail: data.address_detail,
            };
            this.openUpdate = true;
        },

        openDeleteModal(event) {
            const url = event.currentTarget.dataset.url;
            this.deleteRoute = url;
            this.openDelete = true;
        },

        housingProfile: {
            openCreate: false,
            openUpdate: false,

            data: {
                id: "",
                family_id: "",
                house_ownership: null,
                house_condition: "",
                floor_material: "cement_brick",
                wall_material: "mansory_brick",
                roof_material: "clay_tile",
                water_source: "protected_well",
                sanitation_type: "private_flush_toilet",
                cooking_fuel: "lpg_gas",
                electricity_source: "pln_metered",
                electricity_capacity: "900va",
            },

            openModal(event) {
                const jsonData = event.currentTarget.dataset.profile;
                const data = JSON.parse(jsonData);

                this.data = {
                    id: data?.id || "",
                    family_id: data?.family_id || "",
                    house_ownership: data?.house_ownership || null,
                    house_condition: data?.house_condition || "",
                    floor_material: data?.floor_material || "cement_brick",
                    wall_material: data?.wall_material || "mansory_brick",
                    roof_material: data?.roof_material || "clay_tile",
                    water_source: data?.water_source || "protected_well",
                    sanitation_type:
                        data?.sanitation_type || "private_flush_toilet",
                    cooking_fuel: data?.cooking_fuel || "lpg_gas",
                    electricity_source:
                        data?.electricity_source || "pln_metered",
                    electricity_capacity: data?.electricity_capacity || "900va",
                };

                this.openUpdate = true;
            },
        },
    };
}
