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
            keyframes: {
                updown: {
                    "0%, 100%": { transform: "translateY(0)" },
                    "50%": { transform: "translateY(-20%)" },
                },
            },
            animation: {
                updown: "updown 5s ease-in-out infinite",
            },

            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                glacial: ["Glacial Indifference", "sans-serif"],
                boldglacial: ["Glacial Indifference Bold", "sans-serif"],
                monsterat: ["Montserrat", "sans-serif"],
                league: ["Open Sans", "sans-serif"],
                lato: ["Lato", "sans-serif"],
                openSans: ["Open Sans", "sans-serif"],
            },

            fontSize: {
                xs: ".75rem",
                sm: ".875rem",
                tiny: ".875rem",
                base: "1rem",
                lg: "1.125rem",
                xl: "1.25rem",
                "1xl": "1.3rem",
                "2xl": "1.5rem",
                "3xl": "2.0rem",
                "4xl": "2.5rem",
                "5xl": "3.0rem",
                "6xl": "3.9rem",
                "7xl": "4.5rem",
                "8xl": "5.5rem",
                "9xl": "5.0rem",
                "10xl": "8.0rem",
            },

            fontWeight: {
                thin: 100,
                extralight: 200,
                light: 300,
                normal: 400,
                medium: 500,
                bold: 790,
                extrabold: 800,
                black: 900,
            },

            colors: {
                brown: {
                    light: "#FFFFFF",
                    DEFAULT: "#5c6ac4",
                    dark: "#FBF4E4",
                },
                green: {
                    dark: "#1BC037",
                    DEFAULT: "#1BC037",
                    light: "#87D75B",
                },
                white: {
                    DEFAULT: "#FFFFFF",
                    light: "#F7F8F7",
                },
                blue: {
                    light: "#26A2D9",
                    dark: "#C1D2F6",
                    DEFAULT: "#400CFC",
                    border: "#372AAC",
                },
                black: {
                    light: "#2D2006",
                    dark: "#000000",
                },
                violet: {
                    light: "#8C52FF",
                },
                red: {
                    light: "#00BF63",
                    default: "#FBC5C5",
                    dark: "#FF3131",
                },
            },
        },
    },

    plugins: [forms],
};
