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
    };
}
