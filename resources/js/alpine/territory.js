export function territoryData() {
    return {
        openCreate: false,
        openUpdate: false,
        openDelete: false,
        deleteRoute: "",
        data: { id: "", sub_village: "", area_name: "", rw: "", rt: "" },

        openModal(event) {
            const jsonData = event.currentTarget.dataset.territory;
            const data = JSON.parse(jsonData);

            this.data = {
                id: data?.id,
                sub_village: data?.sub_village,
                area_name: data?.area_name,
                rt: data?.rt,
                rw: data?.rw,
            };

            this.openUpdate = true;
        },

        openDeleteModal(event) {
            const url = event.currentTarget.dataset.url;
            this.deleteRoute = url;
            this.openDelete = true;
        },
    };
}
