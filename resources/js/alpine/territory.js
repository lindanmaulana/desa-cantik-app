export function territoryData() {
    return {
        openCreate: false,
        openUpdate: false,
        data: { id: "", sub_village: "", area_name: "", rw: "", rt: "" },

        openModal(event) {
            const jsonData = event.currentTarget.dataset.territory;
            const data = JSON.parse(jsonData);

            console.log({data})

            this.data = {
                id: data?.id,
                sub_village: data?.sub_village,
                area_name: data?.area_name,
                rt: data?.rt,
                rw: data?.rw,
            };

            console.log({data2: data})

            this.openUpdate = true;
        },
    };
}
