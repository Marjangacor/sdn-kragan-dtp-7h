import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
	document.documentElement.classList.add('js');

	const ACCESSIBILITY_KEY = 'sdn-accessibility-settings';
	const htmlElement = document.documentElement;
	const pageRoot = document.querySelector('.school-page');
	const accToggle = document.querySelector('#accessibilityToggle');
	const accPanel = document.querySelector('#accessibilityPanel');
	const accClose = document.querySelector('#accessibilityClose');
	const accReset = document.querySelector('#accessibilityReset');
	const readingGuide = document.querySelector('#readingGuide');
	const accItems = document.querySelectorAll('[data-acc-action]');

	const accessibilityState = {
		fontScale: 100,
		letterSpacing: 0,
		lineHeight: 1.75,
		invert: false,
		grayscale: false,
		underline: false,
		bigCursor: false,
		readingGuide: false,
		reduceMotion: false,
	};

	const clamp = (value, min, max) => Math.min(Math.max(value, min), max);

	const applyAccessibilityState = () => {
		if (!(pageRoot instanceof HTMLElement)) {
			return;
		}

		htmlElement.style.fontSize = `${accessibilityState.fontScale}%`;
		pageRoot.classList.add('accessibility-panel-on');
		pageRoot.style.setProperty('--acc-letter', `${accessibilityState.letterSpacing}em`);
		pageRoot.style.setProperty('--acc-line', `${accessibilityState.lineHeight}`);

		pageRoot.classList.toggle('accessibility-invert', accessibilityState.invert);
		pageRoot.classList.toggle('accessibility-grayscale', accessibilityState.grayscale);
		pageRoot.classList.toggle('accessibility-underline', accessibilityState.underline);
		pageRoot.classList.toggle('accessibility-big-cursor', accessibilityState.bigCursor);
		pageRoot.classList.toggle('accessibility-reduce-motion', accessibilityState.reduceMotion);

		if (readingGuide instanceof HTMLElement) {
			readingGuide.classList.toggle('active', accessibilityState.readingGuide);
		}

		accItems.forEach((item) => {
			const action = item.getAttribute('data-acc-action');
			if (!action) {
				return;
			}

			const map = {
				invert: accessibilityState.invert,
				grayscale: accessibilityState.grayscale,
				underline: accessibilityState.underline,
				'big-cursor': accessibilityState.bigCursor,
				'reading-guide': accessibilityState.readingGuide,
				'reduce-motion': accessibilityState.reduceMotion,
			};

			item.classList.toggle('is-active', Boolean(map[action]));
		});
	};

	const persistAccessibilityState = () => {
		window.localStorage.setItem(ACCESSIBILITY_KEY, JSON.stringify(accessibilityState));
	};

	const loadAccessibilityState = () => {
		const raw = window.localStorage.getItem(ACCESSIBILITY_KEY);
		if (!raw) {
			return;
		}

		try {
			const parsed = JSON.parse(raw);
			Object.assign(accessibilityState, {
				...accessibilityState,
				...parsed,
			});
		} catch {
			window.localStorage.removeItem(ACCESSIBILITY_KEY);
		}
	};

	const setPanelOpen = (open) => {
		if (!(accPanel instanceof HTMLElement) || !(accToggle instanceof HTMLElement)) {
			return;
		}

		accPanel.classList.toggle('open', open);
		accPanel.setAttribute('aria-hidden', open ? 'false' : 'true');
		accToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
	};

	if (readingGuide instanceof HTMLElement) {
		document.addEventListener('mousemove', (event) => {
			if (!accessibilityState.readingGuide) {
				return;
			}
			readingGuide.style.top = `${Math.max(event.clientY - 18, 0)}px`;
		});
	}

	loadAccessibilityState();
	applyAccessibilityState();

	if (accToggle instanceof HTMLElement) {
		accToggle.addEventListener('click', () => {
			const currentlyOpen = accPanel instanceof HTMLElement && accPanel.classList.contains('open');
			setPanelOpen(!currentlyOpen);
		});
	}

	if (accClose instanceof HTMLElement) {
		accClose.addEventListener('click', () => setPanelOpen(false));
	}

	if (accPanel instanceof HTMLElement && accToggle instanceof HTMLElement) {
		document.addEventListener('click', (event) => {
			const target = event.target;
			if (!(target instanceof Node)) {
				return;
			}

			if (accPanel.classList.contains('open') && !accPanel.contains(target) && !accToggle.contains(target)) {
				setPanelOpen(false);
			}
		});
	}

	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape') {
			setPanelOpen(false);
		}
	});

	if (accReset instanceof HTMLElement) {
		accReset.addEventListener('click', () => {
			Object.assign(accessibilityState, {
				fontScale: 100,
				letterSpacing: 0,
				lineHeight: 1.75,
				invert: false,
				grayscale: false,
				underline: false,
				bigCursor: false,
				readingGuide: false,
				reduceMotion: false,
			});
			applyAccessibilityState();
			persistAccessibilityState();
		});
	}

	accItems.forEach((item) => {
		item.addEventListener('click', () => {
			const action = item.getAttribute('data-acc-action');
			if (!action) {
				return;
			}

			switch (action) {
				case 'text-increase':
					accessibilityState.fontScale = clamp(accessibilityState.fontScale + 5, 85, 150);
					break;
				case 'text-decrease':
					accessibilityState.fontScale = clamp(accessibilityState.fontScale - 5, 85, 150);
					break;
				case 'letter-increase':
					accessibilityState.letterSpacing = clamp(accessibilityState.letterSpacing + 0.01, 0, 0.08);
					break;
				case 'letter-decrease':
					accessibilityState.letterSpacing = clamp(accessibilityState.letterSpacing - 0.01, 0, 0.08);
					break;
				case 'line-increase':
					accessibilityState.lineHeight = clamp(accessibilityState.lineHeight + 0.1, 1.3, 2.4);
					break;
				case 'line-decrease':
					accessibilityState.lineHeight = clamp(accessibilityState.lineHeight - 0.1, 1.3, 2.4);
					break;
				case 'invert':
					accessibilityState.invert = !accessibilityState.invert;
					break;
				case 'grayscale':
					accessibilityState.grayscale = !accessibilityState.grayscale;
					break;
				case 'underline':
					accessibilityState.underline = !accessibilityState.underline;
					break;
				case 'big-cursor':
					accessibilityState.bigCursor = !accessibilityState.bigCursor;
					break;
				case 'reading-guide':
					accessibilityState.readingGuide = !accessibilityState.readingGuide;
					break;
				case 'reduce-motion':
					accessibilityState.reduceMotion = !accessibilityState.reduceMotion;
					break;
				default:
					return;
			}

			applyAccessibilityState();
			persistAccessibilityState();
		});
	});

	const menuToggle = document.querySelector('#menuToggle');
	const mobileMenu = document.querySelector('#mobileMenu');
	const header = document.querySelector('header');
	const heroNoise = document.querySelector('.hero-noise');

	if (menuToggle && mobileMenu) {
		menuToggle.setAttribute('aria-expanded', 'false');

		menuToggle.addEventListener('click', () => {
			mobileMenu.classList.toggle('hidden');
			const isOpen = !mobileMenu.classList.contains('hidden');
			menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
		});

		document.addEventListener('click', (event) => {
			if (mobileMenu.classList.contains('hidden')) {
				return;
			}

			const target = event.target;
			if (
				target instanceof Node &&
				!mobileMenu.contains(target) &&
				!menuToggle.contains(target)
			) {
				mobileMenu.classList.add('hidden');
				menuToggle.setAttribute('aria-expanded', 'false');
			}
		});

		document.addEventListener('keydown', (event) => {
			if (event.key === 'Escape') {
				mobileMenu.classList.add('hidden');
				menuToggle.setAttribute('aria-expanded', 'false');
			}
		});
	}

	document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
		anchor.addEventListener('click', (event) => {
			const href = anchor.getAttribute('href');
			if (!href || href === '#') {
				return;
			}

			const target = document.querySelector(href);
			if (!target) {
				return;
			}

			event.preventDefault();
			const headerHeight = header instanceof HTMLElement ? header.offsetHeight : 0;
			const targetPosition = target.getBoundingClientRect().top + window.scrollY - headerHeight - 10;
			window.scrollTo({ top: Math.max(targetPosition, 0), behavior: 'smooth' });

			if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
				mobileMenu.classList.add('hidden');
				menuToggle?.setAttribute('aria-expanded', 'false');
			}
		});
	});

	const navChips = document.querySelectorAll('.nav-list .nav-chip');
	navChips.forEach((chip, index) => {
		window.setTimeout(() => {
			chip.classList.add('nav-in');
		}, 80 + (index * 55));
	});

	const updateHeaderState = () => {
		if (!(header instanceof HTMLElement)) {
			return;
		}

		if (window.scrollY > 16) {
			header.classList.add('is-scrolled');
		} else {
			header.classList.remove('is-scrolled');
		}
	};

	updateHeaderState();
	window.addEventListener('scroll', updateHeaderState, { passive: true });

	if (heroNoise instanceof HTMLElement) {
		window.addEventListener(
			'scroll',
			() => {
				const offset = Math.min(window.scrollY * 0.16, 36);
				heroNoise.style.transform = `translateY(${offset}px)`;
			},
			{ passive: true }
		);
	}

	const rippleButtons = document.querySelectorAll('.ripple-btn');
	rippleButtons.forEach((button) => {
		button.addEventListener('click', (event) => {
			const target = event.currentTarget;
			if (!(target instanceof HTMLElement)) {
				return;
			}

			const wave = document.createElement('span');
			wave.className = 'ripple-wave';
			wave.style.left = `${event.offsetX}px`;
			wave.style.top = `${event.offsetY}px`;
			target.appendChild(wave);

			window.setTimeout(() => {
				wave.remove();
			}, 650);
		});
	});

	const revealItems = document.querySelectorAll('.reveal');
	if (revealItems.length > 0) {
		revealItems.forEach((item) => item.classList.add('is-visible'));

		if (!('IntersectionObserver' in window)) {
			return;
		}

		const revealObserver = new IntersectionObserver(
			(entries, observer) => {
				entries.forEach((entry) => {
					if (!entry.isIntersecting) {
						return;
					}
					entry.target.classList.add('is-visible');
					observer.unobserve(entry.target);
				});
			},
			{ threshold: 0.16 }
		);

		revealItems.forEach((item) => {
			item.classList.remove('is-visible');
			revealObserver.observe(item);
		});
	}

	const animateCounter = (element) => {
		const target = Number(element.dataset.counter || '0');
		if (!Number.isFinite(target) || target <= 0) {
			return;
		}

		const duration = 1300;
		const start = performance.now();

		const update = (time) => {
			const progress = Math.min((time - start) / duration, 1);
			const eased = 1 - Math.pow(1 - progress, 3);
			element.textContent = Math.floor(target * eased).toString();

			if (progress < 1) {
				window.requestAnimationFrame(update);
			} else {
				element.textContent = target.toString();
			}
		};

		window.requestAnimationFrame(update);
	};

	const counters = document.querySelectorAll('[data-counter]');
	if (counters.length > 0) {
		const counterObserver = new IntersectionObserver(
			(entries, observer) => {
				entries.forEach((entry) => {
					if (!entry.isIntersecting) {
						return;
					}
					animateCounter(entry.target);
					observer.unobserve(entry.target);
				});
			},
			{ threshold: 0.6 }
		);

		counters.forEach((counter) => counterObserver.observe(counter));
	}

	const heroCard = document.querySelector('#heroCard');
	const heroFeatureBox = document.querySelector('#heroFeatureBox');
	const heroStats = document.querySelector('#heroStats');
	const heroCtaGroup = document.querySelector('#heroCtaGroup');
	if (heroCard && window.matchMedia('(min-width: 1024px)').matches) {
		heroCard.addEventListener('mousemove', (event) => {
			const rect = heroCard.getBoundingClientRect();
			const x = event.clientX - rect.left;
			const y = event.clientY - rect.top;
			const rotateY = ((x / rect.width) - 0.5) * 8;
			const rotateX = (0.5 - (y / rect.height)) * 8;
			heroCard.style.transform = `perspective(920px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
		});

		heroCard.addEventListener('mouseleave', () => {
			heroCard.style.transform = 'perspective(920px) rotateX(0deg) rotateY(0deg)';
		});
	}

	if (heroCtaGroup instanceof HTMLElement) {
		const ctas = heroCtaGroup.querySelectorAll('.hero-cta');
		ctas.forEach((cta, index) => {
			cta.animate(
				[
					{ transform: 'translateY(10px)', opacity: 0 },
					{ transform: 'translateY(0)', opacity: 1 },
				],
				{
					duration: 520,
					delay: 90 + (index * 120),
					fill: 'both',
					easing: 'cubic-bezier(0.2, 0.8, 0.2, 1)',
				}
			);
		});
	}

	if (heroFeatureBox instanceof HTMLElement) {
		heroFeatureBox.animate(
			[
				{ transform: 'translateY(14px) scale(0.98)', opacity: 0 },
				{ transform: 'translateY(0) scale(1)', opacity: 1 },
			],
			{
				duration: 620,
				delay: 140,
				fill: 'both',
				easing: 'cubic-bezier(0.2, 0.8, 0.2, 1)',
			}
		);
	}

	if (heroStats instanceof HTMLElement) {
		const statCards = heroStats.querySelectorAll('.stat-card-lg');
		statCards.forEach((card, index) => {
			card.animate(
				[
					{ transform: 'translateY(16px) scale(0.96)', opacity: 0 },
					{ transform: 'translateY(0) scale(1)', opacity: 1 },
				],
				{
					duration: 560,
					delay: 180 + (index * 130),
					fill: 'both',
					easing: 'cubic-bezier(0.2, 0.8, 0.2, 1)',
				}
			);

			card.addEventListener('mousemove', (event) => {
				if (!window.matchMedia('(min-width: 1024px)').matches) {
					return;
				}

				const rect = card.getBoundingClientRect();
				const x = event.clientX - rect.left;
				const y = event.clientY - rect.top;
				const rotateY = ((x / rect.width) - 0.5) * 7;
				const rotateX = (0.5 - (y / rect.height)) * 7;
				card.style.transform = `perspective(700px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-4px)`;
			});

			card.addEventListener('mouseleave', () => {
				card.style.transform = 'perspective(700px) rotateX(0deg) rotateY(0deg) translateY(0)';
			});
		});
	}
});
