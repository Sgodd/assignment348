module.exports = {
  purge: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue'

  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
      transitionProperty: ['responsive', 'motion-safe', 'motion-reduce'],
      
    extend: {
        opacity: ['disabled'],
        backgroundColor: ['active'],
    },
  },
  plugins: [
    require('@tailwindcss/forms')
  ],
}
