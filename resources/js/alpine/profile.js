export function profileData() {
    return {
        openUpdatePassword: false,
        openModalEdit: false,

        user: {
            id: "",
            username: "",
            fullname: "",
            role: "",
        },

        openEditProfileModal(data) {
            this.user = {
                id: data.id,
                username: data.username,
                fullname: data.fullname,
                role: data.role,
            };
            this.openModalEdit = true;
        },

        openPasswordModal() {
            this.openUpdatePassword = true;
        },
    };
}
