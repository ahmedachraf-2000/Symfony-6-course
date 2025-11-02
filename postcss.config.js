// postcss.config.js
module.exports = {
  plugins: {
    'postcss-import': {},
    tailwindcss: { config: './tailwind.config.js' },
    autoprefixer: {},
  },
};
