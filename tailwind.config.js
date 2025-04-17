/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './templates/**/*.html.twig', // Adaptez ce chemin à vos fichiers
    './assets/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        // Section Primary Colors
        'primary-color': {
          'green-main': '#16a34a', // Correspond à green-600
          'black': '#000000',
          'white': '#ffffff',
        },
        // Section Secondary Colors
        'secondary-color': {
          'blue-light': '#3b82f6', // Exemple de bleu clair
          'gray-dark': '#374151', // Exemple de gris foncé
        },
      },
    },
  },
  plugins: [],
};
