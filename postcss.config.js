const tailwindcss = require('tailwindcss');
const tailwindcssNesting = require('tailwindcss/nesting');
const autoprefixer = require('autoprefixer');
const postcssSass = require('@csstools/postcss-sass');

/** @type {import('postcss').Postcss} */
const config = {
	plugins: [
		postcssSass,
		//Some plugins, like tailwindcss/nesting, need to run before Tailwind,
		tailwindcssNesting(),
		tailwindcss(),
		//But others, like autoprefixer, need to run after,
		autoprefixer,
	],
};

module.exports = config;
