import "./bootstrap";

import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";
import ApexCharts from "apexcharts";
import citizenData from "./alpine/citizen.js";
import { SocialEconomyData } from "./alpine/social-economy";
import { familyData } from "./alpine/family";
import { territoryData } from "./alpine/territory";
import { msmeData } from "./alpine/msme";
import { infrastructureData } from "./alpine/infrastructure";
import initSpatialModule from "./alpine/spatial-data";
import { renderBarChart } from "./charts/barChart";
import { renderDonutChart } from "./charts/donutChart";
import { manageAdminData } from "./alpine/manage-admin.js";
import { profileData } from "./alpine/profile.js";
import "./colors";
import "./charts";

Alpine.plugin(collapse);
window.Alpine = Alpine;
window.ApexCharts = ApexCharts;

document.addEventListener("alpine:init", () => {
    Alpine.data("citizenData", citizenData);
    Alpine.data("familyData", familyData);
    Alpine.data("socialEconomyData", SocialEconomyData);
    Alpine.data("territoryData", territoryData);
    Alpine.data("msmeData", msmeData);
    Alpine.data("infrastructureData", infrastructureData);
    Alpine.data("manageAdminData", manageAdminData);

    Alpine.data("profileData", profileData);

    initSpatialModule();

    Alpine.store("navLoading", {
        activeKey: null,

        start(key) {
            this.activeKey = key;
        },

        isLoading(key) {
            return this.activeKey === key;
        },

        reset() {
            this.activeKey = null;
        },
    });
});

window.addEventListener("pageshow", (event) => {
    if (event.persisted && window.Alpine?.store("navLoading")) {
        Alpine.store("navLoading").reset();
    }
});

Alpine.start();
