import { render, useState } from '@wordpress/element';
import { MediaUpload } from '@wordpress/block-editor';
import { Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

type Value = {
	id: number;
	url: string;
}[];

const Slideshow = ({
	value: originalValue,
	input,
}: {
	value: Value;
	input: HTMLInputElement;
}): JSX.Element => {
	const [state, setState] = useState(originalValue);

	return (
		<MediaUpload
			onSelect={(media: { id: number; url: string }[]) => {
				const value: Value = media.map(({ id, url }) => ({ id, url }));
				input.value = JSON.stringify(value);
				input.dispatchEvent(new Event('change'));
				setState(value);
			}}
			allowedTypes={['image']}
			multiple={true}
			value={state.map((v) => v.id)}
			render={({ open }) => (
				<Button onClick={open} variant="primary">
					{__('Select slideshow images', 'ftek-theme')}
				</Button>
			)}
		/>
	);
};

const intervalId = window.setInterval(renderSelectors, 1000);
function renderSelectors() {
	const containers = document.getElementsByClassName(
		'ftek-theme-slideshow-image-selector'
	);
	if (0 === containers.length) {
		return;
	}

	Array.from(containers).forEach((container) => {
		const input: HTMLInputElement = container.querySelector('input');

		const value: Value =
			JSON.parse(
				input.attributes.getNamedItem('value')?.value || 'false'
			) || [];

		const root = document.createElement('div');
		container.appendChild(root);
		render(<Slideshow value={value} input={input} />, root);
	});

	window.clearInterval(intervalId);
}
