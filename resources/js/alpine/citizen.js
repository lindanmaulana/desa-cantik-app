export default function citizenData() {
    return {
        openData: false,
        openCreate: false,
        openUpdate: false,

        healthProfile: {
            openCreate: false,
            openUpdate: false,

            data: {
                disability_type: "none",
                is_pregnant: false,
                bpjs_status: "none",
                kb_method: "none",
            },

            openModal(event) {
                const jsonData = event.currentTarget.dataset.profile;
                const data = JSON.parse(jsonData);

                this.data = {
                    disability_type: data?.disability_type || "none",
                    is_pregnant: data?.is_pregnant || false,
                    bpjs_status: data?.bpjs_status || "none",
                    kb_method: data?.kb_method || "none",
                };

                this.openUpdate = true;
            },
        },

        educationProfile: {
            openCreate: false,
            openUpdate: false,

            data: {
                education_level: "none",
                highest_diploma: "none",
                school_participation: "not_yet_school",
            },

            openModal(event) {
                const jsonData = event.currentTarget.dataset.profile;
                const data = JSON.parse(jsonData);

                this.data = {
                    education_level: data?.education_level || "none",
                    highest_diploma: data?.highest_diploma || "none",
                    school_participation: data?.school_participation || "not_yet_school",
                };

                this.openUpdate = true;
            },
        },

        // citizen: {
        //     id: "",
        //     family_id: "",
        //     id_number: "",
        //     full_name: "",
        //     family_role: "",
        //     gender: "",
        //     birth_place: "",
        //     birth_date: "",
        //     religion: "",
        //     marital_status: "",
        //     blood_type: "",
        //     education_profile: {
        //         education_level: "none",
        //         highest_diploma: "none",
        //         school_participation: "not_yet_school",
        //     },
        //     employment_profile: {
        //         occupation: "unemployed",
        //         job_sector: "other",
        //         employment_status: "unpaid_worker",
        //         monthly_income: 0,
        //         economic_status: "middle_income",
        //         is_welfare_recipient: false,
        //         assistance_type: "",
        //     },
        //     health_profile: {
        //         disability_type: "none",
        //         is_pregnant: false,
        //         bpjs_status: "none",
        //         kb_method: "none",
        //     },
        //     housing_profile: {
        //         house_ownership: "owned",
        //         house_condition: "proper",
        //         floor_material: "cement_brick",
        //         wall_material: "masonry_brick",
        //         roof_material: "clay_tile",
        //         water_source: "protected_well",
        //         sanitation_type: "private_toilet",
        //         cooking_fuel: "lpg_gas",
        //         electricity_source: "state_electricity_metered",
        //         electricity_capacity: "900va",
        //     },
        // },

        // openModal(data) {
        //     this.citizen = {
        //         id: data.id,
        //         family_id: data.family_id || "",
        //         id_number: data.id_number,
        //         full_name: data.full_name,
        //         family_role: data.family_role || "",
        //         gender: data.gender || "",
        //         birth_place: data.birth_place || "",
        //         birth_date: data.birth_date || "",
        //         religion: data.religion || "",
        //         marital_status: data.marital_status || "",
        //         blood_type: data.blood_type || "",
        //         education_profile: {
        //             education_level:
        //                 data.education_profile?.education_level || "none",
        //             highest_diploma:
        //                 data.education_profile?.highest_diploma || "none",
        //             school_participation:
        //                 data.education_profile?.school_participation ||
        //                 "not_yet_school",
        //         },
        //         employment_profile: {
        //             occupation:
        //                 data.employment_profile?.occupation || "unemployed",
        //             job_sector: data.employment_profile?.job_sector || "other",
        //             employment_status:
        //                 data.employment_profile?.employment_status ||
        //                 "unpaid_worker",
        //             monthly_income:
        //                 data.employment_profile?.monthly_income || 0,
        //             economic_status:
        //                 data.employment_profile?.economic_status ||
        //                 "middle_income",
        //             is_welfare_recipient:
        //                 data.employment_profile?.is_welfare_recipient || false,
        //             assistance_type:
        //                 data.employment_profile?.assistance_type || "",
        //         },
        //         health_profile: {
        //             disability_type:
        //                 data.health_profile?.disability_type || "none",
        //             is_pregnant: data.health_profile?.is_pregnant || false,
        //             bpjs_status: data.health_profile?.bpjs_status || "none",
        //             kb_method: data.health_profile?.kb_method || "none",
        //         },
        //         housing_profile: {
        //             house_ownership:
        //                 data.housing_profile?.house_ownership || "owned",
        //             house_condition:
        //                 data.housing_profile?.house_condition || "proper",
        //             floor_material:
        //                 data.housing_profile?.floor_material || "cement_brick",
        //             wall_material:
        //                 data.housing_profile?.wall_material || "masonry_brick",
        //             roof_material:
        //                 data.housing_profile?.roof_material || "clay_tile",
        //             water_source:
        //                 data.housing_profile?.water_source || "protected_well",
        //             sanitation_type:
        //                 data.housing_profile?.sanitation_type ||
        //                 "private_toilet",
        //             cooking_fuel:
        //                 data.housing_profile?.cooking_fuel || "lpg_gas",
        //             electricity_source:
        //                 data.housing_profile?.electricity_source ||
        //                 "state_electricity_metered",
        //             electricity_capacity:
        //                 data.housing_profile?.electricity_capacity || "900va",
        //         },
        //     };

        //     this.openUpdate = true;
        // },
    };
}
