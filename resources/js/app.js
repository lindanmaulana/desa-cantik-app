import './bootstrap';

import Alpine from 'alpinejs';
import collapse from "@alpinejs/collapse";
import ApexCharts from 'apexcharts';
import citizenData from './alpine/citizen';
import { SocialEconomyData } from './alpine/social-economy';
import { familyData } from './alpine/family';
import { territorieData } from './alpine/territorie';
import { msmeData } from './alpine/msme';
import { spatialData } from './alpine/spatial-data';

Alpine.plugin(collapse);

window.Alpine = Alpine;
window.ApexCharts = ApexCharts;

Alpine.data('citizenData', citizenData)
Alpine.data('familyData', familyData)
Alpine.data('socialEconomyData', SocialEconomyData)
Alpine.data('territorieData', territorieData)
Alpine.data('msmeData', msmeData)
Alpine.data('spatialData', spatialData)
Alpine.start();
