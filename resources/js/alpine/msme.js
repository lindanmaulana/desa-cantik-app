export function msmeData() {
    return {
        openData: false,
        openCreate: false,
        openUpdate: false,
        msme: {
            id: "",
            citizen_id: "",
            business_name: "",
            business_category: "",
            license_number: "",
            employee_count: 0,
            mothly_revenue: "",
        },

        openModal(data) {
            this.msme = {
                id: data.id,
                citizen_id: data.citizen_id || "",
                business_name: data.business_name || "",
                business_category: data.business_category || "",
                license_number: data.license_number || "",
                employee_count: data.employee_count || 0,
                mothly_revenue: data.mothly_revenue || "",
            };
            this.openUpdate = true;
        },
    };
}
