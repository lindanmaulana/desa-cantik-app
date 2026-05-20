export function SocialEconomyData() {
    return {
        openData: false,
        openCreate: false,
        openUpdate: false,
        profile: {
            id: "",
            citizen_id: "",
            education_level: "",
            occupation: "",
            monthly_income: "",
            is_welfare_recipient: "0",
            assistance_type: "",
            house_condition: "",
            economic_status: "",
        },

        openModal(data) {
            this.profile = {
                id: data.id,
                citizen_id: data.citizen_id || "",
                education_level: data.education_level || "",
                occupation: data.occupation || "",
                monthly_income: data.monthly_income || "",
                is_welfare_recipient: data.is_welfare_recipient ? "1" : "0",
                assistance_type: data.assistance_type || "",
                house_condition: data.house_condition || "",
                economic_status: data.economic_status || "",
            };

            this.openUpdate = true;
        },
    };
}
