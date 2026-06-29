export function msmeData() {
    return {
        openData: false,
        openCreate: false,
        openUpdate: false,
        openDelete: false,
        submitting: false,
        deleteRoute: '',
        
        msme: {
            id: "",
            citizen_id: "",
            business_name: "",
            business_category: "",
            license_number: "",
            employee_count: 0,
            monthly_revenue: 0,
            legal_entity_type: "unregistered",
            uses_digital_payment: false,
            digita_platform_type: "none",
            capital_source: "personal",
            is_environmentally_friendly: false,
            bumdes_partnership_status: "none",
        },

        openModal(data) {
            this.msme = {
                id: data.id,
                citizen_id: data.citizen_id || "",
                business_name: data.business_name || "",
                business_category:
                    data.business_category?.value ||
                    data.business_category ||
                    "",
                license_number: data.license_number || "",
                employee_count: data.employee_count || 0,
                monthly_revenue: data.monthly_revenue || 0,
                legal_entity_type:
                    data.legal_entity_type?.value ||
                    data.legal_entity_type ||
                    "unregistered",
                uses_digital_payment:
                    data.uses_digital_payment == 1 ||
                    data.uses_digital_payment === true,
                digita_platform_type:
                    data.digita_platform_type?.value ||
                    data.digita_platform_type ||
                    "none",
                capital_source:
                    data.capital_source?.value ||
                    data.capital_source ||
                    "personal",
                is_environmentally_friendly:
                    data.is_environmentally_friendly == 1 ||
                    data.is_environmentally_friendly === true,
                bumdes_partnership_status:
                    data.bumdes_partnership_status?.value ||
                    data.bumdes_partnership_status ||
                    "none",
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
