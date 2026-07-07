export function manageAdminData() {
    return {
        openData: false,
        openCreate: false,
        openUpdate: false,
        openDelete: false,
        deleteRoute: "",

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

        openDeleteModal(event) {
            const url = event.currentTarget.dataset.url;
            console.log("URL yang didapat:", url)
            this.deleteRoute = url;
            this.openDelete = true;
        },
    };
}
