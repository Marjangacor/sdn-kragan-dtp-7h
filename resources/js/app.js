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
		lineHeight: 1.6,
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
				lineHeight: 1.6,
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
	const heroLogoOrbit = document.querySelector('.js-logo-orbit');
	const heroOrbitBookLeft = document.querySelector('.hero-emblem-book-left');
	const heroOrbitBookRight = document.querySelector('.hero-emblem-book-right');
	const heroFeatureBox = document.querySelector('#heroFeatureBox');
	const heroStats = document.querySelector('#heroStats');
	const heroCtaGroup = document.querySelector('#heroCtaGroup');
	const cardElements = Array.from(document.querySelectorAll('.js-card'));
	const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
	const shouldReduceMotion = () => accessibilityState.reduceMotion || prefersReducedMotion.matches;

	if (
		heroLogoOrbit instanceof HTMLElement &&
		heroOrbitBookLeft instanceof HTMLElement &&
		heroOrbitBookRight instanceof HTMLElement &&
		!shouldReduceMotion()
	) {
		const orbitMotion = (time) => {
			if (shouldReduceMotion()) {
				heroOrbitBookLeft.style.transform = 'none';
				heroOrbitBookRight.style.transform = 'none';
				heroLogoOrbit.style.transform = 'none';
				window.requestAnimationFrame(orbitMotion);
				return;
			}

			const phase = time / 780;
			const leftLift = Math.sin(phase) * 4;
			const rightLift = Math.cos(phase + 0.8) * 4;
			const leftRotate = Math.sin(phase) * 5;
			const rightRotate = Math.cos(phase + 0.8) * -5;

			heroOrbitBookLeft.style.transform = `translateY(${leftLift}px) rotate(${leftRotate}deg)`;
			heroOrbitBookRight.style.transform = `translateY(${rightLift}px) rotate(${rightRotate}deg)`;

			window.requestAnimationFrame(orbitMotion);
		};

		window.requestAnimationFrame(orbitMotion);
	}

	const animateCard = (card, index) => {
		if (!(card instanceof HTMLElement)) {
			return;
		}

		const isHeroCard = card.id === 'heroCard';

		card.classList.add('card-animated');

		if (shouldReduceMotion()) {
			card.style.opacity = '1';
			card.style.transform = 'none';
			return;
		}

		card.animate(
			[
				{ transform: 'translateY(22px) scale(0.96)', opacity: 0 },
				{ transform: 'translateY(0) scale(1)', opacity: 1 },
			],
			{
				duration: 680,
				delay: 70 + (index * 90),
				fill: 'both',
				easing: 'cubic-bezier(0.2, 0.8, 0.2, 1)',
			}
		);

		if (isHeroCard || !window.matchMedia('(min-width: 1024px)').matches) {
			return;
		}

		card.addEventListener('mousemove', (event) => {
			if (shouldReduceMotion()) {
				return;
			}

			const rect = card.getBoundingClientRect();
			const x = event.clientX - rect.left;
			const y = event.clientY - rect.top;
			const rotateY = ((x / rect.width) - 0.5) * 6;
			const rotateX = (0.5 - (y / rect.height)) * 6;
			card.style.transform = `perspective(900px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-2px)`;
		});

		card.addEventListener('mouseleave', () => {
			if (shouldReduceMotion()) {
				return;
			}

			card.style.transform = 'none';
		});
	};

	if (cardElements.length > 0) {
		if (!('IntersectionObserver' in window) || shouldReduceMotion()) {
			cardElements.forEach((card, index) => animateCard(card, index));
		} else {
			const cardObserver = new IntersectionObserver(
				(entries, observer) => {
					entries.forEach((entry) => {
						if (!entry.isIntersecting) {
							return;
						}

						const index = cardElements.indexOf(entry.target);
						animateCard(entry.target, index >= 0 ? index : 0);
						observer.unobserve(entry.target);
					});
				},
				{ threshold: 0.18 }
			);

			cardElements.forEach((card) => cardObserver.observe(card));
		}
	}
	if (heroCard && window.matchMedia('(min-width: 1024px)').matches) {
		heroCard.addEventListener('mousemove', (event) => {
			if (shouldReduceMotion()) {
				return;
			}

			const rect = heroCard.getBoundingClientRect();
			const x = event.clientX - rect.left;
			const y = event.clientY - rect.top;
			const rotateY = ((x / rect.width) - 0.5) * 8;
			const rotateX = (0.5 - (y / rect.height)) * 8;
			heroCard.style.transform = `perspective(920px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;

			if (heroLogoOrbit instanceof HTMLElement) {
				heroLogoOrbit.style.transform = `rotateX(${rotateX * 0.35}deg) rotateY(${rotateY * 0.35}deg)`;
			}
		});

		heroCard.addEventListener('mouseleave', () => {
			if (shouldReduceMotion()) {
				return;
			}

			heroCard.style.transform = 'perspective(920px) rotateX(0deg) rotateY(0deg)';

			if (heroLogoOrbit instanceof HTMLElement) {
				heroLogoOrbit.style.transform = 'none';
			}
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

	if (document.body.classList.contains('admin-page')) {
		document.querySelectorAll('.admin-hero-shape').forEach((shape, index) => {
			shape.style.animationDelay = `${index * 140}ms`;
		});

		document.querySelectorAll('.admin-animate').forEach((item, index) => {
			item.style.setProperty('--reveal-delay', `${90 + index * 80}ms`);
			item.classList.add('is-visible');
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
			card.addEventListener('mousemove', (event) => {
				if (!window.matchMedia('(min-width: 1024px)').matches || shouldReduceMotion()) {
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
				if (shouldReduceMotion()) {
					return;
				}

				card.style.transform = 'perspective(700px) rotateX(0deg) rotateY(0deg) translateY(0)';
			});
		});
	}

	const guruPage = document.querySelector('.guru-page');
	if (guruPage instanceof HTMLElement) {
		const guruCards = Array.from(guruPage.querySelectorAll('[data-guru-card][data-type]'));
		const guruCounters = Array.from(guruPage.querySelectorAll('[data-counter-target]'));
		const filterButtons = Array.from(guruPage.querySelectorAll('.guru-filter-btn'));
		const guruFadeItems = Array.from(guruPage.querySelectorAll('[data-guru-fade]'));
		const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

		if (guruFadeItems.length > 0) {
			if (reduceMotion || !('IntersectionObserver' in window)) {
				guruFadeItems.forEach((item) => item.classList.add('is-visible'));
			} else {
				const fadeObserver = new IntersectionObserver(
					(entries, observer) => {
						entries.forEach((entry) => {
							if (!entry.isIntersecting) {
								return;
							}

							const index = guruFadeItems.indexOf(entry.target);
							window.setTimeout(() => {
								entry.target.classList.add('is-visible');
							}, 90 + (Math.max(index, 0) * 110));
							observer.unobserve(entry.target);
						});
					},
					{ threshold: 0.2 }
				);

				guruFadeItems.forEach((item) => fadeObserver.observe(item));
			}
		}

		const animateGuruCounter = (element) => {
			if (!(element instanceof HTMLElement)) {
				return;
			}

			const target = Number(element.dataset.counterTarget || '0');
			if (!Number.isFinite(target) || target < 0) {
				return;
			}

			if (reduceMotion) {
				element.textContent = target.toString();
				return;
			}

			const start = performance.now();
			const duration = 1200;

			const frame = (time) => {
				const progress = Math.min((time - start) / duration, 1);
				const eased = 1 - Math.pow(1 - progress, 3);
				element.textContent = Math.floor(target * eased).toString();

				if (progress < 1) {
					window.requestAnimationFrame(frame);
				}
			};

			window.requestAnimationFrame(frame);
		};

		if (guruCounters.length > 0) {
			if (!('IntersectionObserver' in window)) {
				guruCounters.forEach((counter) => animateGuruCounter(counter));
			} else {
				const counterObserver = new IntersectionObserver(
					(entries, observer) => {
						entries.forEach((entry) => {
							if (!entry.isIntersecting) {
								return;
							}
							animateGuruCounter(entry.target);
							observer.unobserve(entry.target);
						});
					},
					{ threshold: 0.55 }
				);

				guruCounters.forEach((counter) => counterObserver.observe(counter));
			}
		}

		if (guruCards.length > 0) {
			const revealCard = (card, index) => {
				if (!(card instanceof HTMLElement)) {
					return;
				}

				if (reduceMotion) {
					card.classList.add('is-visible');
					return;
				}

				card.animate(
					[
						{ opacity: 0, transform: 'translateY(20px) scale(0.97)' },
						{ opacity: 1, transform: 'translateY(0) scale(1)' },
					],
					{
						duration: 540,
						delay: 60 + (index * 75),
						easing: 'cubic-bezier(0.2, 0.8, 0.2, 1)',
						fill: 'both',
					}
				);

				card.classList.add('is-visible');
			};

			if (!('IntersectionObserver' in window)) {
				guruCards.forEach((card, index) => revealCard(card, index));
			} else {
				const cardObserver = new IntersectionObserver(
					(entries, observer) => {
						entries.forEach((entry) => {
							if (!entry.isIntersecting) {
								return;
							}

							const index = guruCards.indexOf(entry.target);
							revealCard(entry.target, index >= 0 ? index : 0);
							observer.unobserve(entry.target);
						});
					},
					{ threshold: 0.15 }
				);

				guruCards.forEach((card) => cardObserver.observe(card));
			}
		}

		const setFilter = (filterType) => {
			guruCards.forEach((card) => {
				const type = card.getAttribute('data-type');
				const show = filterType === 'all' || type === filterType;

				if (show) {
					card.hidden = false;
					if (!reduceMotion) {
						card.animate(
							[
								{ opacity: 0, transform: 'translateY(10px) scale(0.98)' },
								{ opacity: 1, transform: 'translateY(0) scale(1)' },
							],
							{ duration: 260, easing: 'ease-out', fill: 'both' }
						);
					}
				} else {
					if (reduceMotion) {
						card.hidden = true;
						return;
					}

					const animation = card.animate(
						[
							{ opacity: 1, transform: 'translateY(0) scale(1)' },
							{ opacity: 0, transform: 'translateY(10px) scale(0.98)' },
						],
						{ duration: 220, easing: 'ease-in', fill: 'both' }
					);

					animation.onfinish = () => {
						card.hidden = true;
					};
				}
			});
		};

		filterButtons.forEach((button) => {
			button.addEventListener('click', () => {
				const filterType = button.getAttribute('data-filter-type') || 'all';

				filterButtons.forEach((item) => {
					item.classList.toggle('is-active', item === button);
					item.setAttribute('aria-selected', item === button ? 'true' : 'false');
				});

				setFilter(filterType);
			});
		});
	}

	const galeriPage = document.querySelector('.galeri-page');
	if (galeriPage instanceof HTMLElement) {
		const modal = document.querySelector('#galeriDetailModal');
		const modalImage = document.querySelector('#galeriModalImage');
		const modalCategory = document.querySelector('#galeriModalCategory');
		const modalTitle = document.querySelector('#galeriModalTitle');
		const modalDate = document.querySelector('#galeriModalDate');
		const modalDescription = document.querySelector('#galeriModalDescription');
		const openButtons = Array.from(document.querySelectorAll('.galeri-detail-trigger'));
		const closeButtons = Array.from(document.querySelectorAll('[data-galeri-modal-close]'));

		if (
			modal instanceof HTMLElement &&
			modalImage instanceof HTMLImageElement &&
			modalCategory instanceof HTMLElement &&
			modalTitle instanceof HTMLElement &&
			modalDate instanceof HTMLElement &&
			modalDescription instanceof HTMLElement
		) {
			const openModal = (button) => {
				if (!(button instanceof HTMLElement)) {
					return;
				}

				const title = button.getAttribute('data-title') || 'Detail kegiatan';
				const category = button.getAttribute('data-category') || '-';
				const description = button.getAttribute('data-description') || '-';
				const image = button.getAttribute('data-image') || '';
				const date = button.getAttribute('data-date') || 'Tanggal belum ditentukan';

				modalImage.src = image;
				modalImage.alt = title;
				modalCategory.textContent = category;
				modalTitle.textContent = title;
				modalDate.textContent = date;
				modalDescription.textContent = description;

				modal.classList.add('is-open');
				modal.setAttribute('aria-hidden', 'false');
				document.body.style.overflow = 'hidden';
			};

			const closeModal = () => {
				modal.classList.remove('is-open');
				modal.setAttribute('aria-hidden', 'true');
				document.body.style.overflow = '';
			};

			openButtons.forEach((button) => {
				button.addEventListener('click', () => openModal(button));
			});

			closeButtons.forEach((button) => {
				button.addEventListener('click', closeModal);
			});

			document.addEventListener('keydown', (event) => {
				if (event.key === 'Escape' && modal.classList.contains('is-open')) {
					closeModal();
				}
			});
		}
	}

	const ekstraPage = document.querySelector('.ekstra-page');
	if (ekstraPage instanceof HTMLElement) {
		const extraCards = Array.from(ekstraPage.querySelectorAll('[data-ekstra-card]'));
		const extraCounters = Array.from(ekstraPage.querySelectorAll('[data-counter]'));
		const extraFilters = Array.from(ekstraPage.querySelectorAll('.ekstra-filter-btn'));
		const extraFadeItems = Array.from(ekstraPage.querySelectorAll('[data-ekstra-fade]'));
		const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

		if (extraFadeItems.length > 0) {
			if (reduceMotion || !('IntersectionObserver' in window)) {
				extraFadeItems.forEach((item) => item.classList.add('is-visible'));
			} else {
				const fadeObserver = new IntersectionObserver(
					(entries, observer) => {
						entries.forEach((entry) => {
							if (!entry.isIntersecting) {
								return;
							}

							const index = extraFadeItems.indexOf(entry.target);
							window.setTimeout(() => {
								entry.target.classList.add('is-visible');
							}, 80 + (Math.max(index, 0) * 100));
							observer.unobserve(entry.target);
						});
					},
					{ threshold: 0.18 }
				);

				extraFadeItems.forEach((item) => fadeObserver.observe(item));
			}
		}

		const animateExtraCounter = (element) => {
			if (!(element instanceof HTMLElement)) {
				return;
			}

			const target = Number(element.dataset.counter || '0');
			if (!Number.isFinite(target) || target < 0) {
				return;
			}

			if (reduceMotion) {
				element.textContent = target.toString();
				return;
			}

			const start = performance.now();
			const duration = 1200;

			const frame = (time) => {
				const progress = Math.min((time - start) / duration, 1);
				const eased = 1 - Math.pow(1 - progress, 3);
				element.textContent = Math.floor(target * eased).toString();

				if (progress < 1) {
					window.requestAnimationFrame(frame);
				}
			};

			window.requestAnimationFrame(frame);
		};

		if (extraCounters.length > 0) {
			if (!('IntersectionObserver' in window)) {
				extraCounters.forEach((counter) => animateExtraCounter(counter));
			} else {
				const counterObserver = new IntersectionObserver(
					(entries, observer) => {
						entries.forEach((entry) => {
							if (!entry.isIntersecting) {
								return;
							}
							animateExtraCounter(entry.target);
							observer.unobserve(entry.target);
						});
					},
					{ threshold: 0.55 }
				);

				extraCounters.forEach((counter) => counterObserver.observe(counter));
			}
		}

		if (extraCards.length > 0) {
			const revealCard = (card, index) => {
				if (!(card instanceof HTMLElement)) {
					return;
				}

				if (reduceMotion) {
					card.classList.add('is-visible');
					return;
				}

				card.animate(
					[
						{ opacity: 0, transform: 'translateY(18px) scale(0.98)' },
						{ opacity: 1, transform: 'translateY(0) scale(1)' },
					],
					{
						duration: 520,
						delay: 50 + (index * 70),
						easing: 'cubic-bezier(0.2, 0.8, 0.2, 1)',
						fill: 'both',
					}
				);

				card.classList.add('is-visible');
			};

			if (!('IntersectionObserver' in window)) {
				extraCards.forEach((card, index) => revealCard(card, index));
			} else {
				const cardObserver = new IntersectionObserver(
					(entries, observer) => {
						entries.forEach((entry) => {
							if (!entry.isIntersecting) {
								return;
							}

							const index = extraCards.indexOf(entry.target);
							revealCard(entry.target, index >= 0 ? index : 0);
							observer.unobserve(entry.target);
						});
					},
					{ threshold: 0.18 }
				);

				extraCards.forEach((card) => cardObserver.observe(card));
			}
		}

		const setExtraFilter = (filterType) => {
			extraCards.forEach((card) => {
				const category = card.getAttribute('data-category');
				const show = filterType === 'all' || category === filterType;

				if (show) {
					card.hidden = false;
					if (!reduceMotion) {
						card.animate(
							[
								{ opacity: 0, transform: 'translateY(10px) scale(0.98)' },
								{ opacity: 1, transform: 'translateY(0) scale(1)' },
							],
							{ duration: 240, easing: 'ease-out', fill: 'both' }
						);
					}
				} else {
					if (reduceMotion) {
						card.hidden = true;
						return;
					}

					const animation = card.animate(
						[
							{ opacity: 1, transform: 'translateY(0) scale(1)' },
							{ opacity: 0, transform: 'translateY(10px) scale(0.98)' },
						],
						{ duration: 210, easing: 'ease-in', fill: 'both' }
					);

					animation.onfinish = () => {
						card.hidden = true;
					};
				}
			});
		};

		extraFilters.forEach((button) => {
			button.addEventListener('click', () => {
				const filterType = button.getAttribute('data-ekstra-filter') || 'all';

				extraFilters.forEach((item) => {
					item.classList.toggle('is-active', item === button);
					item.setAttribute('aria-selected', item === button ? 'true' : 'false');
				});

				setExtraFilter(filterType);
			});
		});

		const ekstraCtaBoxes = Array.from(ekstraPage.querySelectorAll('.ekstra-cta-box'));
		if (ekstraCtaBoxes.length > 0) {
			const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

			const revealCtaBox = (box, index) => {
				if (!(box instanceof HTMLElement)) {
					return;
				}

				if (reduceMotion) {
					box.classList.add('is-visible');
					return;
				}

				box.animate(
					[
						{ opacity: 0, transform: 'translateY(24px) scale(0.96)' },
						{ opacity: 1, transform: 'translateY(0) scale(1)' },
					],
					{
						duration: 580,
						delay: 100 + (index * 120),
						easing: 'cubic-bezier(0.2, 0.8, 0.2, 1)',
						fill: 'both',
					}
				);

				box.classList.add('is-visible');
			};

			if (!('IntersectionObserver' in window)) {
				ekstraCtaBoxes.forEach((box, index) => revealCtaBox(box, index));
			} else {
				const ctaBoxObserver = new IntersectionObserver(
					(entries, observer) => {
						entries.forEach((entry) => {
							if (!entry.isIntersecting) {
								return;
							}

							const index = ekstraCtaBoxes.indexOf(entry.target);
							revealCtaBox(entry.target, index >= 0 ? index : 0);
							observer.unobserve(entry.target);
						});
					},
					{ threshold: 0.15 }
				);

				ekstraCtaBoxes.forEach((box) => ctaBoxObserver.observe(box));
			}
		}
	}

	const spmbPage = document.querySelector('.spmb-page');
	if (spmbPage instanceof HTMLElement) {
		const spmbCards = Array.from(spmbPage.querySelectorAll('[data-spmb-card]'));
		const spmbCounters = Array.from(spmbPage.querySelectorAll('[data-counter]'));
		const spmbFadeItems = Array.from(spmbPage.querySelectorAll('[data-spmb-fade]'));
		const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

		if (spmbFadeItems.length > 0) {
			if (reduceMotion || !('IntersectionObserver' in window)) {
				spmbFadeItems.forEach((item) => item.classList.add('is-visible'));
			} else {
				const fadeObserver = new IntersectionObserver(
					(entries, observer) => {
						entries.forEach((entry) => {
							if (!entry.isIntersecting) {
								return;
							}

							const index = spmbFadeItems.indexOf(entry.target);
							window.setTimeout(() => {
								entry.target.classList.add('is-visible');
							}, 90 + (Math.max(index, 0) * 100));
							observer.unobserve(entry.target);
						});
					},
					{ threshold: 0.2 }
				);

				spmbFadeItems.forEach((item) => fadeObserver.observe(item));
			}
		}

		const animateSpmbCounter = (element) => {
			if (!(element instanceof HTMLElement)) {
				return;
			}

			const target = Number(element.dataset.counter || '0');
			if (!Number.isFinite(target) || target < 0) {
				return;
			}

			if (reduceMotion) {
				element.textContent = target.toString();
				return;
			}

			const start = performance.now();
			const duration = 1150;

			const frame = (time) => {
				const progress = Math.min((time - start) / duration, 1);
				const eased = 1 - Math.pow(1 - progress, 3);
				element.textContent = Math.floor(target * eased).toString();

				if (progress < 1) {
					window.requestAnimationFrame(frame);
				}
			};

			window.requestAnimationFrame(frame);
		};

		if (spmbCounters.length > 0) {
			if (!('IntersectionObserver' in window)) {
				spmbCounters.forEach((counter) => animateSpmbCounter(counter));
			} else {
				const counterObserver = new IntersectionObserver(
					(entries, observer) => {
						entries.forEach((entry) => {
							if (!entry.isIntersecting) {
								return;
							}
							animateSpmbCounter(entry.target);
							observer.unobserve(entry.target);
						});
					},
					{ threshold: 0.55 }
				);

				spmbCounters.forEach((counter) => counterObserver.observe(counter));
			}
		}

		if (spmbCards.length > 0) {
			const revealCard = (card, index) => {
				if (!(card instanceof HTMLElement)) {
					return;
				}

				if (reduceMotion) {
					card.classList.add('is-visible');
					return;
				}

				card.animate(
					[
						{ opacity: 0, transform: 'translateY(18px) scale(0.98)' },
						{ opacity: 1, transform: 'translateY(0) scale(1)' },
					],
					{
						duration: 520,
						delay: 60 + (index * 75),
						easing: 'cubic-bezier(0.2, 0.8, 0.2, 1)',
						fill: 'both',
					}
				);

				card.classList.add('is-visible');
			};

			if (!('IntersectionObserver' in window)) {
				spmbCards.forEach((card, index) => revealCard(card, index));
			} else {
				const cardObserver = new IntersectionObserver(
					(entries, observer) => {
						entries.forEach((entry) => {
							if (!entry.isIntersecting) {
								return;
							}

							const index = spmbCards.indexOf(entry.target);
							revealCard(entry.target, index >= 0 ? index : 0);
							observer.unobserve(entry.target);
						});
					},
					{ threshold: 0.18 }
				);

				spmbCards.forEach((card) => cardObserver.observe(card));
			}
		}

		const spmbCtaBoxes = Array.from(spmbPage.querySelectorAll('.spmb-cta-box'));
		if (spmbCtaBoxes.length > 0) {
			const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

			const revealCtaBox = (box, index) => {
				if (!(box instanceof HTMLElement)) {
					return;
				}

				if (reduceMotion) {
					box.classList.add('is-visible');
					return;
				}

				box.animate(
					[
						{ opacity: 0, transform: 'translateY(24px) scale(0.96)' },
						{ opacity: 1, transform: 'translateY(0) scale(1)' },
					],
					{
						duration: 580,
						delay: 100 + (index * 120),
						easing: 'cubic-bezier(0.2, 0.8, 0.2, 1)',
						fill: 'both',
					}
				);

				box.classList.add('is-visible');
			};

			if (!('IntersectionObserver' in window)) {
				spmbCtaBoxes.forEach((box, index) => revealCtaBox(box, index));
			} else {
				const ctaBoxObserver = new IntersectionObserver(
					(entries, observer) => {
						entries.forEach((entry) => {
							if (!entry.isIntersecting) {
								return;
							}

							const index = spmbCtaBoxes.indexOf(entry.target);
							revealCtaBox(entry.target, index >= 0 ? index : 0);
							observer.unobserve(entry.target);
						});
					},
					{ threshold: 0.15 }
				);

				spmbCtaBoxes.forEach((box) => ctaBoxObserver.observe(box));
			}
		}
	}

	const kritikPage = document.querySelector('.kritik-page');
	if (kritikPage instanceof HTMLElement) {
		const kritikCards = Array.from(kritikPage.querySelectorAll('[data-kritik-card]'));
		const kritikCounters = Array.from(kritikPage.querySelectorAll('[data-counter]'));
		const kritikFadeItems = Array.from(kritikPage.querySelectorAll('[data-kritik-fade]'));
		const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

		if (kritikFadeItems.length > 0) {
			if (reduceMotion || !('IntersectionObserver' in window)) {
				kritikFadeItems.forEach((item) => item.classList.add('is-visible'));
			} else {
				const fadeObserver = new IntersectionObserver(
					(entries, observer) => {
						entries.forEach((entry) => {
							if (!entry.isIntersecting) {
								return;
							}

							const index = kritikFadeItems.indexOf(entry.target);
							window.setTimeout(() => {
								entry.target.classList.add('is-visible');
							}, 90 + (Math.max(index, 0) * 100));
							observer.unobserve(entry.target);
						});
					},
					{ threshold: 0.2 }
				);

				kritikFadeItems.forEach((item) => fadeObserver.observe(item));
			}
		}

		const animateKritikCounter = (element) => {
			if (!(element instanceof HTMLElement)) {
				return;
			}

			const target = Number(element.dataset.counter || '0');
			if (!Number.isFinite(target) || target < 0) {
				return;
			}

			if (reduceMotion) {
				element.textContent = target.toString();
				return;
			}

			const start = performance.now();
			const duration = 1150;

			const frame = (time) => {
				const progress = Math.min((time - start) / duration, 1);
				const eased = 1 - Math.pow(1 - progress, 3);
				element.textContent = Math.floor(target * eased).toString();

				if (progress < 1) {
					window.requestAnimationFrame(frame);
				}
			};

			window.requestAnimationFrame(frame);
		};

		if (kritikCounters.length > 0) {
			if (!('IntersectionObserver' in window)) {
				kritikCounters.forEach((counter) => animateKritikCounter(counter));
			} else {
				const counterObserver = new IntersectionObserver(
					(entries, observer) => {
						entries.forEach((entry) => {
							if (!entry.isIntersecting) {
								return;
							}
							animateKritikCounter(entry.target);
							observer.unobserve(entry.target);
						});
					},
					{ threshold: 0.55 }
				);

				kritikCounters.forEach((counter) => counterObserver.observe(counter));
			}
		}

		if (kritikCards.length > 0) {
			const revealCard = (card, index) => {
				if (!(card instanceof HTMLElement)) {
					return;
				}

				if (reduceMotion) {
					card.classList.add('is-visible');
					return;
				}

				card.animate(
					[
						{ opacity: 0, transform: 'translateY(18px) scale(0.98)' },
						{ opacity: 1, transform: 'translateY(0) scale(1)' },
					],
					{
						duration: 520,
						delay: 60 + (index * 75),
						easing: 'cubic-bezier(0.2, 0.8, 0.2, 1)',
						fill: 'both',
					}
				);

				card.classList.add('is-visible');
			};

			if (!('IntersectionObserver' in window)) {
				kritikCards.forEach((card, index) => revealCard(card, index));
			} else {
				const cardObserver = new IntersectionObserver(
					(entries, observer) => {
						entries.forEach((entry) => {
							if (!entry.isIntersecting) {
								return;
							}

							const index = kritikCards.indexOf(entry.target);
							revealCard(entry.target, index >= 0 ? index : 0);
							observer.unobserve(entry.target);
						});
					},
					{ threshold: 0.18 }
				);

				kritikCards.forEach((card) => cardObserver.observe(card));
			}
		}

		const kritikCtaBoxes = Array.from(kritikPage.querySelectorAll('.kritik-cta-box'));
		if (kritikCtaBoxes.length > 0) {
			const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

			const revealCtaBox = (box, index) => {
				if (!(box instanceof HTMLElement)) {
					return;
				}

				if (reduceMotion) {
					box.classList.add('is-visible');
					return;
				}

				box.animate(
					[
						{ opacity: 0, transform: 'translateY(24px) scale(0.96)' },
						{ opacity: 1, transform: 'translateY(0) scale(1)' },
					],
					{
						duration: 580,
						delay: 100 + (index * 120),
						easing: 'cubic-bezier(0.2, 0.8, 0.2, 1)',
						fill: 'both',
					}
				);

				box.classList.add('is-visible');
			};

			if (!('IntersectionObserver' in window)) {
				kritikCtaBoxes.forEach((box, index) => revealCtaBox(box, index));
			} else {
				const ctaBoxObserver = new IntersectionObserver(
					(entries, observer) => {
						entries.forEach((entry) => {
							if (!entry.isIntersecting) {
								return;
							}

							const index = kritikCtaBoxes.indexOf(entry.target);
							revealCtaBox(entry.target, index >= 0 ? index : 0);
							observer.unobserve(entry.target);
						});
					},
					{ threshold: 0.15 }
				);

				kritikCtaBoxes.forEach((box) => ctaBoxObserver.observe(box));
			}
		}
	}

	const prestasiPage = document.querySelector('.prestasi-page');
	if (prestasiPage instanceof HTMLElement) {
		const prestasiCards = Array.from(prestasiPage.querySelectorAll('[data-prestasi-card]'));
		const prestasiCounters = Array.from(prestasiPage.querySelectorAll('[data-counter]'));
		const prestasiFadeItems = Array.from(prestasiPage.querySelectorAll('[data-prestasi-fade]'));
		const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

		if (prestasiFadeItems.length > 0) {
			if (reduceMotion || !('IntersectionObserver' in window)) {
				prestasiFadeItems.forEach((item) => item.classList.add('is-visible'));
			} else {
				const fadeObserver = new IntersectionObserver(
					(entries, observer) => {
						entries.forEach((entry) => {
							if (!entry.isIntersecting) {
								return;
							}

							const index = prestasiFadeItems.indexOf(entry.target);
							window.setTimeout(() => {
								entry.target.classList.add('is-visible');
							}, 90 + (Math.max(index, 0) * 100));
							observer.unobserve(entry.target);
						});
					},
					{ threshold: 0.2 }
				);

				prestasiFadeItems.forEach((item) => fadeObserver.observe(item));
			}
		}

		const animatePrestasiCounter = (element) => {
			if (!(element instanceof HTMLElement)) {
				return;
			}

			const target = Number(element.dataset.counter || '0');
			if (!Number.isFinite(target) || target < 0) {
				return;
			}

			if (reduceMotion) {
				element.textContent = target.toString();
				return;
			}

			const start = performance.now();
			const duration = 1150;

			const frame = (time) => {
				const progress = Math.min((time - start) / duration, 1);
				const eased = 1 - Math.pow(1 - progress, 3);
				element.textContent = Math.floor(target * eased).toString();

				if (progress < 1) {
					window.requestAnimationFrame(frame);
				}
			};

			window.requestAnimationFrame(frame);
		};

		if (prestasiCounters.length > 0) {
			if (!('IntersectionObserver' in window)) {
				prestasiCounters.forEach((counter) => animatePrestasiCounter(counter));
			} else {
				const counterObserver = new IntersectionObserver(
					(entries, observer) => {
						entries.forEach((entry) => {
							if (!entry.isIntersecting) {
								return;
							}
							animatePrestasiCounter(entry.target);
							observer.unobserve(entry.target);
						});
					},
					{ threshold: 0.55 }
				);

				prestasiCounters.forEach((counter) => counterObserver.observe(counter));
			}
		}

		if (prestasiCards.length > 0) {
			const revealCard = (card, index) => {
				if (!(card instanceof HTMLElement)) {
					return;
				}

				if (reduceMotion) {
					card.classList.add('is-visible');
					return;
				}

				card.animate(
					[
						{ opacity: 0, transform: 'translateY(18px) scale(0.98)' },
						{ opacity: 1, transform: 'translateY(0) scale(1)' },
					],
					{
						duration: 520,
						delay: 60 + (index * 75),
						easing: 'cubic-bezier(0.2, 0.8, 0.2, 1)',
						fill: 'both',
					}
				);

				card.classList.add('is-visible');
			};

			if (!('IntersectionObserver' in window)) {
				prestasiCards.forEach((card, index) => revealCard(card, index));
			} else {
				const cardObserver = new IntersectionObserver(
					(entries, observer) => {
						entries.forEach((entry) => {
							if (!entry.isIntersecting) {
								return;
							}

							const index = prestasiCards.indexOf(entry.target);
							revealCard(entry.target, index >= 0 ? index : 0);
							observer.unobserve(entry.target);
						});
					},
					{ threshold: 0.18 }
				);

				prestasiCards.forEach((card) => cardObserver.observe(card));
			}
		}

		const prestasiCtaBoxes = Array.from(prestasiPage.querySelectorAll('.prestasi-cta-box'));
		if (prestasiCtaBoxes.length > 0) {
			const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

			const revealCtaBox = (box, index) => {
				if (!(box instanceof HTMLElement)) {
					return;
				}

				if (reduceMotion) {
					box.classList.add('is-visible');
					return;
				}

				box.animate(
					[
						{ opacity: 0, transform: 'translateY(24px) scale(0.96)' },
						{ opacity: 1, transform: 'translateY(0) scale(1)' },
					],
					{
						duration: 580,
						delay: 100 + (index * 120),
						easing: 'cubic-bezier(0.2, 0.8, 0.2, 1)',
						fill: 'both',
					}
				);

				box.classList.add('is-visible');
			};

			if (!('IntersectionObserver' in window)) {
				prestasiCtaBoxes.forEach((box, index) => revealCtaBox(box, index));
			} else {
				const ctaBoxObserver = new IntersectionObserver(
					(entries, observer) => {
						entries.forEach((entry) => {
							if (!entry.isIntersecting) {
								return;
							}

							const index = prestasiCtaBoxes.indexOf(entry.target);
							revealCtaBox(entry.target, index >= 0 ? index : 0);
							observer.unobserve(entry.target);
						});
					},
					{ threshold: 0.15 }
				);

				prestasiCtaBoxes.forEach((box) => ctaBoxObserver.observe(box));
			}
		}
	}

	const kontakPage = document.querySelector('.kontak-page');
	if (kontakPage instanceof HTMLElement) {
		const kontakCards = Array.from(kontakPage.querySelectorAll('[data-kontak-card]'));
		const kontakCounters = Array.from(kontakPage.querySelectorAll('[data-counter]'));
		const kontakFadeItems = Array.from(kontakPage.querySelectorAll('[data-kontak-fade]'));
		const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

		if (kontakFadeItems.length > 0) {
			if (reduceMotion || !('IntersectionObserver' in window)) {
				kontakFadeItems.forEach((item) => item.classList.add('is-visible'));
			} else {
				const fadeObserver = new IntersectionObserver(
					(entries, observer) => {
						entries.forEach((entry) => {
							if (!entry.isIntersecting) {
								return;
							}

							const index = kontakFadeItems.indexOf(entry.target);
							window.setTimeout(() => {
								entry.target.classList.add('is-visible');
							}, 90 + (Math.max(index, 0) * 100));
							observer.unobserve(entry.target);
						});
					},
					{ threshold: 0.2 }
				);

				kontakFadeItems.forEach((item) => fadeObserver.observe(item));
			}
		}

		const animateKontakCounter = (element) => {
			if (!(element instanceof HTMLElement)) {
				return;
			}

			const target = Number(element.dataset.counter || '0');
			if (!Number.isFinite(target) || target < 0) {
				return;
			}

			if (reduceMotion) {
				element.textContent = target.toString();
				return;
			}

			const start = performance.now();
			const duration = 1150;

			const frame = (time) => {
				const progress = Math.min((time - start) / duration, 1);
				const eased = 1 - Math.pow(1 - progress, 3);
				element.textContent = Math.floor(target * eased).toString();

				if (progress < 1) {
					window.requestAnimationFrame(frame);
				}
			};

			window.requestAnimationFrame(frame);
		};

		if (kontakCounters.length > 0) {
			if (!('IntersectionObserver' in window)) {
				kontakCounters.forEach((counter) => animateKontakCounter(counter));
			} else {
				const counterObserver = new IntersectionObserver(
					(entries, observer) => {
						entries.forEach((entry) => {
							if (!entry.isIntersecting) {
								return;
							}
							animateKontakCounter(entry.target);
							observer.unobserve(entry.target);
						});
					},
					{ threshold: 0.55 }
				);

				kontakCounters.forEach((counter) => counterObserver.observe(counter));
			}
		}

		if (kontakCards.length > 0) {
			const revealCard = (card, index) => {
				if (!(card instanceof HTMLElement)) {
					return;
				}

				if (reduceMotion) {
					card.classList.add('is-visible');
					return;
				}

				card.animate(
					[
						{ opacity: 0, transform: 'translateY(18px) scale(0.98)' },
						{ opacity: 1, transform: 'translateY(0) scale(1)' },
					],
					{
						duration: 520,
						delay: 60 + (index * 75),
						easing: 'cubic-bezier(0.2, 0.8, 0.2, 1)',
						fill: 'both',
					}
				);

				card.classList.add('is-visible');
			};

			if (!('IntersectionObserver' in window)) {
				kontakCards.forEach((card, index) => revealCard(card, index));
			} else {
				const cardObserver = new IntersectionObserver(
					(entries, observer) => {
						entries.forEach((entry) => {
							if (!entry.isIntersecting) {
								return;
							}

							const index = kontakCards.indexOf(entry.target);
							revealCard(entry.target, index >= 0 ? index : 0);
							observer.unobserve(entry.target);
						});
					},
					{ threshold: 0.18 }
				);

				kontakCards.forEach((card) => cardObserver.observe(card));
			}
		}

		const kontakCtaBoxes = Array.from(kontakPage.querySelectorAll('.kontak-cta-box'));
		if (kontakCtaBoxes.length > 0) {
			const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

			const revealCtaBox = (box, index) => {
				if (!(box instanceof HTMLElement)) {
					return;
				}

				if (reduceMotion) {
					box.classList.add('is-visible');
					return;
				}

				box.animate(
					[
						{ opacity: 0, transform: 'translateY(24px) scale(0.96)' },
						{ opacity: 1, transform: 'translateY(0) scale(1)' },
					],
					{
						duration: 580,
						delay: 100 + (index * 120),
						easing: 'cubic-bezier(0.2, 0.8, 0.2, 1)',
						fill: 'both',
					}
				);

				box.classList.add('is-visible');
			};

			if (!('IntersectionObserver' in window)) {
				kontakCtaBoxes.forEach((box, index) => revealCtaBox(box, index));
			} else {
				const ctaBoxObserver = new IntersectionObserver(
					(entries, observer) => {
						entries.forEach((entry) => {
							if (!entry.isIntersecting) {
								return;
							}

							const index = kontakCtaBoxes.indexOf(entry.target);
							revealCtaBox(entry.target, index >= 0 ? index : 0);
							observer.unobserve(entry.target);
						});
					},
					{ threshold: 0.15 }
				);

				kontakCtaBoxes.forEach((box) => ctaBoxObserver.observe(box));
			}
		}
	}

	const loginPage = document.querySelector('.login-page');
	if (loginPage instanceof HTMLElement) {
		const loginStage = loginPage.querySelector('[data-login-stage]');
		const loginFloaters = Array.from(loginPage.querySelectorAll('[data-login-float]'));
		const loginFieldWrappers = Array.from(loginPage.querySelectorAll('[data-login-field]'));
		const loginPassword = loginPage.querySelector('#loginPassword');
		const loginPasswordToggle = loginPage.querySelector('#loginPasswordToggle');
		const loginPasswordLabel = loginPage.querySelector('[data-login-password-label]');
		const loginForm = loginPage.querySelector('#loginForm');
		const loginSubmit = loginPage.querySelector('#loginSubmit');
		const loginReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

		if (loginStage instanceof HTMLElement && !loginReducedMotion) {
			loginStage.animate(
				[
					{ transform: 'translateY(18px) scale(0.98)', opacity: 0 },
					{ transform: 'translateY(0) scale(1)', opacity: 1 },
				],
				{
					duration: 620,
					easing: 'cubic-bezier(0.2, 0.8, 0.2, 1)',
					fill: 'both',
				}
			);
		}

		loginFieldWrappers.forEach((fieldWrapper) => {
			const input = fieldWrapper.querySelector('input');
			if (!(input instanceof HTMLInputElement)) {
				return;
			}

			const syncFocusState = () => {
				fieldWrapper.classList.toggle('is-focused', document.activeElement === input);
			};

			input.addEventListener('focus', syncFocusState);
			input.addEventListener('blur', syncFocusState);
			syncFocusState();
		});

		if (loginPassword instanceof HTMLInputElement && loginPasswordToggle instanceof HTMLButtonElement) {
			const syncPasswordToggle = () => {
				const isHidden = loginPassword.type === 'password';
				loginPasswordToggle.setAttribute('aria-pressed', isHidden ? 'false' : 'true');

				if (loginPasswordLabel instanceof HTMLElement) {
					loginPasswordLabel.textContent = isHidden ? 'Tampilkan' : 'Sembunyikan';
				}
			};

			loginPasswordToggle.addEventListener('click', () => {
				loginPassword.type = loginPassword.type === 'password' ? 'text' : 'password';
				syncPasswordToggle();
				loginPassword.focus();
			});

			syncPasswordToggle();
		}

		if (loginFloaters.length > 0 && !loginReducedMotion) {
			const floatLoginAccents = (time) => {
				loginFloaters.forEach((item, index) => {
					if (!(item instanceof HTMLElement)) {
						return;
					}

					const depth = Number(item.dataset.loginFloat || index + 1);
					const offsetX = Math.sin((time / 1100) + (depth * 0.72)) * 6;
					const offsetY = Math.cos((time / 1450) + (depth * 0.88)) * 8;
					item.style.transform = `translate3d(${offsetX}px, ${offsetY}px, 0)`;
				});

				window.requestAnimationFrame(floatLoginAccents);
			};

			window.requestAnimationFrame(floatLoginAccents);
		}

		if (loginForm instanceof HTMLFormElement && loginSubmit instanceof HTMLButtonElement) {
			loginForm.addEventListener('submit', () => {
				loginSubmit.classList.add('is-submitting');
				loginSubmit.setAttribute('aria-busy', 'true');
				loginSubmit.disabled = true;

				const submitLabel = loginSubmit.querySelector('[data-login-submit-label]');
				if (submitLabel instanceof HTMLElement) {
					submitLabel.textContent = 'Memproses...';
				}
			});
		}
	}
});
