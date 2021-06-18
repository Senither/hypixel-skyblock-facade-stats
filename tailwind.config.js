module.exports = {
  mode: 'jit',
  purge: [
    './resources/**/*.blade.php',
  ],
  darkMode: false,
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/typography'),
  ],
}
