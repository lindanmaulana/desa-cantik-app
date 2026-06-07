import { renderBarChart } from "./barChart";
import { renderDonutChart } from "./donutChart";

window.demographicsType = window.demographicsType || {};

window.ChartOptions = {
    series: [],
    colors: window.AppColors.chartPalette,
};

window.renderBarChart = renderBarChart;
window.renderDonutChart = renderDonutChart;
