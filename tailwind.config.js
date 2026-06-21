import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },

            colors: {
                primary: "#2D60FF",
                secondary: "#FFFFFF",
                tertiary: "#F5F7FA",

                textPrimary: "#333B69",
                textSecondary: "#718EBF",
                textTertiary: "#B1B1B1",
            },

            keyframes: {
                "wave-rotate": {
                    from: { transform: "rotate(0deg)" },
                    to: { transform: "rotate(360deg)" },
                },
            },
            animation: {
                wave: "wave-rotate 10s linear infinite",
                "wave-slow": "wave-rotate 15s linear infinite",
                "wave-slower": "wave-rotate 25s linear infinite",
            },
        },
    },

    plugins: [forms],
};
