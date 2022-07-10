const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
const config = {
	content: ['./src/**/*.{ts,tsx}', './*.php', './template-parts/*.php'],
	theme: {
		extend: {
			colors: {
				'dark-gray': '#1d2327',
			},
			fontFamily: {
				sans: ['Roboto', ...defaultTheme.fontFamily.sans],
				serif: ['Latin Modern Roman', ...defaultTheme.fontFamily.serif],
			},
		},
	},
	plugins: [],
};

module.exports = config;
