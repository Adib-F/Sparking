import plugin from 'tailwindcss/plugin';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        biru_tua: "#1E376B",
        biru_muda: "#00CCFF",
        hijau: "#376A3F",
        birumuda_login: "#DCF8FF",
        birutua_login: "#89E4FC",
        birutua_loginhover: "#6EB4C6",
      },

      fontFamily: {
        poppins: ["Poppins", "sans-serif"],
        londrina: ['"Londrina Shadow"', 'cursive'],
      },
    },
  },
  plugins: [
    require('daisyui'),
    require('flowbite/plugin'),
    plugin(function ({ addUtilities }) {
      addUtilities({
        '.text-outline': {
          color: 'transparent',
          '-webkit-text-stroke': '1px white',
          '-webkit-background-clip': 'text',
          'background-clip': 'text',
        },
      });
    }),
  ],
}
