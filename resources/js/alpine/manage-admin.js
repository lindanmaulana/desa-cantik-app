export function manageAdminData() {
    return {
        openData: false,
        openCreate: false,
        openUpdate: false,
        user: {
            id: "",
            username: "",
            password: "",
            fullname: "",
            role: "",
        },

        openModal(data) {
            this.user = {
                id: data.id,
                username: data.username || "",
                password: data.password || "",
                fullname: data.fullname || "",
                role: data.role || "",
            };
            this.openUpdate = true;
        },
    };
}
