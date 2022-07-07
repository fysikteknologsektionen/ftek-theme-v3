window.addEventListener('DOMContentLoaded', () => {
	let index = 0;

	const indicators = Array.from(
		document.getElementsByClassName('ftek-theme-slideshow-indicator')
	);

	if (indicators.length === 0) {
		return;
	}

	const left = document.getElementById('ftek-theme-slideshow-left');
	const right = document.getElementById('ftek-theme-slideshow-right');
	const frame = document.getElementById('ftek-theme-slideshow-frame');

	const _setIndex = (i: number) => {
		const selectedClass = indicators[index].className;
		indicators[index].className = indicators[i].className;
		indicators[i].className = selectedClass;

		left?.toggleAttribute?.('disabled', i === 0);
		right?.toggleAttribute?.('disabled', indicators.length - 1 === i);

		frame?.style?.setProperty?.('left', `${-i * 100}%`);

		index = i;
	};

	const autoscroll = window.setInterval(
		() => _setIndex((index + 1) % indicators.length),
		5000
	);

	const setIndex = (i: number) => {
		_setIndex(i);
		window.clearInterval(autoscroll);
	};

	indicators.forEach((indicator, i) =>
		indicator.addEventListener('click', () => setIndex(i))
	);

	left?.addEventListener?.('click', () => setIndex(index - 1));
	right?.addEventListener?.('click', () => setIndex(index + 1));

	_setIndex(index);
});
