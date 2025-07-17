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
        'dost-blue': '#00ACEC',
        'dost-dark': '#1F2937',
        'dost-light': '#FEFEFE',
      },
      fontFamily: {
        'nokia': ['Nokia', 'monospace'],
      }
    },
  },
  plugins: [],
}