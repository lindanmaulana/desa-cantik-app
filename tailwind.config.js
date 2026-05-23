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
                primary: "#009689",
                secondary: "#00786F",
                tertiary: "#46ECD5",
                quaternary: "#F0FDFA",
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
