/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'selector',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
            DEFAULT: '#4f46e5', // indigo-600
        },
        secondary: {
            DEFAULT: '#ea580c', // orange-600
        },
        info: {
            DEFAULT: '#2563eb', // blue-600
        }
      }
    },
  },
  plugins: [],
}
