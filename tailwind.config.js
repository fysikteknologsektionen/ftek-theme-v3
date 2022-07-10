/** @type {import('tailwindcss').Config} */
const config = {
	content: ['./src/**/*.{ts,tsx}', './*.php', './template-parts/*.php'],
	theme: {
		extend: {
			colors: {
				'dark-gray': '#1d2327',
			},
		},
	},
	plugins: [],
};

module.exports = config;
