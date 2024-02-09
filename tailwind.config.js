/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
        backgroundSize: {
            'size-200': '200% 200%',
        },
        backgroundPosition: {
            'pos-0': '0% 0%',
            'pos-100': '100% 100%',
        },
        colors: {
            'primary-red': '#f54b64',
            'primary-orange': '#f78361',
            'secondary': '#202531',
            'dark-gray': '#4e586e',
            'white': '#fff'
        },
    },
  },
  plugins: [],
}

