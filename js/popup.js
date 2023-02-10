const open_btn = document.querySelector('.open-btn');
const close_btn = document.querySelector('.close-btn');
const popup = document.querySelector('.popup');
const main_popup = document.querySelector('.main-popup');

setTimeout(() => {
	popup.style.display = 'flex';
	main_popup.style.cssText = 'animation:slide-in .5s ease; opacity: 1; animation-fill-mode: forwards;';
}, 9000);

close_btn.addEventListener('click', () => {
	main_popup.style.cssText = 'animation:slide-out .5s ease; opacity: 0; animation-fill-mode: forwards;';
	setTimeout(() => {
		popup.style.display = 'none';
	}, 600);
});

window.addEventListener('click', (e) => {
	if (e.target == document.querySelector('.popup-overlay')) {
		main_popup.style.cssText = 'animation:slide-out .5s ease; opacity: 0; animation-fill-mode: forwards;';
		setTimeout(() => {
			popup.style.display = 'none';
		}, 600);
	}
});