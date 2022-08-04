import { MediaUpload } from '@wordpress/block-editor';
import { Button, PanelRow } from '@wordpress/components';
import { render, useState } from '@wordpress/element';
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

	const setValue = (value: Value) => {
		input.value = JSON.stringify(value);
		input.dispatchEvent(new Event('change'));
		setState(value);
	};

	return (
		<>
			{' '}
			<PanelRow>
				<b>{__('Slideshow', 'ftek-theme')}</b>
			</PanelRow>
			<PanelRow>
				<MediaUpload
					onSelect={(media: { id: number; url: string }[]) =>
						setValue(media.map(({ id, url }) => ({ id, url })))
					}
					allowedTypes={['image']}
					multiple={true}
					value={state.map((v) => v.id)}
					render={({ open }) => (
						<Button onClick={open} variant="primary">
							{__('Select images', 'ftek-theme')}
						</Button>
					)}
				/>
				<Button onClick={() => setValue([])} variant="seconday">
					{__('Clear images', 'ftek-theme')}
				</Button>
			</PanelRow>
		</>
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
