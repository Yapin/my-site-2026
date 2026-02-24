document.addEventListener("DOMContentLoaded", function () {
	const container = document.querySelector(".mv__rotate");
	if (!container) return;

	const words = container.querySelectorAll("span");
	if (!words.length) return;

	// prefers-reduced-motion: reduce の場合は、最初の単語のみ表示してアニメーションを行わない
	const prefersReducedMotion =
		window.matchMedia &&
		window.matchMedia("(prefers-reduced-motion: reduce)").matches;

	if (prefersReducedMotion) {
		words.forEach((word, i) => {
			if (i === 0) {
				word.classList.add("active");
			} else {
				word.classList.remove("active");
			}
		});
		return;
	}

	let index = 0;

	// 初期状態で最初の要素に active が付いている前提
	setTimeout(() => {
		setInterval(() => {
			if (!words.length) return;

			words[index].classList.remove("active");
			index = (index + 1) % words.length;
			words[index].classList.add("active");
		}, 4000);
	}, 3000);
}
);

