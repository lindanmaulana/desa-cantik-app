export default function citizenData() {
    return {
        openData: false,
        openCreate: false,
        openUpdate: false,
        citizen: {
            id: "",
            family_id: "",
            id_number: "",
            full_name: "",
            family_role: "",
            gender: "",
            birth_place: "",
            birth_date: "",
            religion: "",
            marital_status: "",
            blood_type: "",
        },

        openModal(data) {
            this.citizen = {
                id: data.id,
                family_id: data.family_id || "",
                id_number: data.id_number,
                full_name: data.full_name,
                family_role: data.family_role || "",
                gender: data.gender || "",
                birth_place: data.birth_place || "",
                birth_date: data.birth_date || "",
                religion: data.religion || "",
                marital_status: data.marital_status || "",
                blood_type: data.blood_type || "",
            };

            this.openUpdate = true;
        },
    };
}
