/** @type {import('stylelint').Config} */
module.exports = {
	extends: '@wordpress/stylelint-config',
	customSyntax: 'postcss-scss',
	rules: {
		'at-rule-no-unknown': [
			true,
			{
				ignoreAtRules: [
					'tailwind',
					'apply',
					'variants',
					'responsive',
					'screen',
				],
			},
		],
		'rule-empty-line-before': null,
		'at-rule-empty-line-before': null,
	},
	ignoreFiles: ['./style.css*'],
};
