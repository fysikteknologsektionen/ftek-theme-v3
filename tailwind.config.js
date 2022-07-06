/** @type {import('tailwindcss').Config} */
const config = {
	content: ['./src/**/*.{ts,tsx}', './*.php', './includes/*.php'],
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
