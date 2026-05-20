export function territorieData() {
    return {
        openCreate: false,
        openUpdate: false,
        territory: { id: "", sub_village: "", area_name: "", rw: "", rt: "" },

        openModal(data) {
            this.territory = data;
            this.openUpdate = true;
        },
    };
}
