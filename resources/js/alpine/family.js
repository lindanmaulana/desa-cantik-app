export function familyData() {
    return {
        openData: false,
        openCreate: false,
        openUpdate: false,
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

        housingProfile: {
            openCreate: false,
            openUpdate: false,

            data: {
                id: "",
                floor_area_per_capita: "",
                floor_material: "",
                wall_material: "",
                water_source: "",
                sanitation_type: "",
                cooking_fuel: "",
                electricity_source: "",
                electricity_capacity: "",
            },

            openModal(event) {
                const jsonData = event.currentTarget.dataset.profile;
                const data = JSON.parse(jsonData);

                this.data = {
                    id: data?.id || "",
                    floor_area_per_capita: data?.floor_area_per_capita || "",
                    floor_material: data?.floor_material || "",
                    wall_material: data?.wall_material || "",
                    water_source: data?.water_source || "",
                    sanitation_type: data?.sanitation_type || "",
                    cooking_fuel: data?.cooking_fuel || "",
                    electricity_source: data?.electricity_source || "",
                    electricity_capacity: data?.electricity_capacity || "",
                };

                this.openUpdate = true;
            },
        },
    };
}
