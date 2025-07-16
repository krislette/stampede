/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'dost-blue': '#3B82F6',
        'dost-dark': '#1F2937',
        'dost-light': '#F8FAFC',
      }
    },
  },
  plugins: [],
}