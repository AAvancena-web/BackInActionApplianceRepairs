/**
 * Back In Action theme interactions.
 * Header state, off-canvas nav, scroll reveal, parallax, process line,
 * scroll progress, scroll-to-top (reCAPTCHA aware), form helpers.
 */
(function () {
	'use strict';

	var doc = document;
	var root = doc.documentElement;
	var body = doc.body;
	var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	root.classList.add('js');

	/* Header, progress bar and scroll-to-top ---------------------------- */
	var header = doc.querySelector('[data-header]');
	var progress = doc.querySelector('.scroll-progress span');
	var toTop = doc.querySelector('[data-to-top]');
	var ring = toTop ? toTop.querySelector('circle') : null;
	var RING_LEN = 138.2;
	var ticking = false;

	function onScroll() {
		var y = window.scrollY || window.pageYOffset;
		var max = Math.max(1, root.scrollHeight - window.innerHeight);
		var pct = Math.min(1, y / max);

		if (header) header.classList.toggle('is-scrolled', y > 40);
		if (progress) progress.style.transform = 'scaleX(' + pct + ')';
		if (toTop) toTop.classList.toggle('is-visible', y > window.innerHeight * 0.6);
		if (ring) ring.style.strokeDashoffset = String(RING_LEN - RING_LEN * pct);

		parallax();
		ticking = false;
	}

	window.addEventListener('scroll', function () {
		if (!ticking) {
			window.requestAnimationFrame(onScroll);
			ticking = true;
		}
	}, { passive: true });
	window.addEventListener('resize', onScroll);

	if (toTop) {
		toTop.addEventListener('click', function () {
			window.scrollTo({ top: 0, behavior: reduceMotion ? 'auto' : 'smooth' });
		});
	}

	/* Parallax ------------------------------------------------------------ */
	var parallaxEls = reduceMotion ? [] : Array.prototype.slice.call(doc.querySelectorAll('[data-parallax]'));

	function parallax() {
		if (!parallaxEls.length) return;
		var vh = window.innerHeight;
		parallaxEls.forEach(function (el) {
			var rect = el.getBoundingClientRect();
			if (rect.bottom < -200 || rect.top > vh + 200) return;
			var factor = parseFloat(el.getAttribute('data-parallax')) || 0.1;
			var offset = (rect.top + rect.height / 2 - vh / 2) * factor * -1;
			el.style.transform = 'translate3d(0,' + offset.toFixed(1) + 'px,0)';
		});
	}

	/* Off-canvas navigation ---------------------------------------------- */
	var navToggle = doc.querySelector('[data-nav-toggle]');
	var nav = doc.querySelector('[data-nav]');

	function setNav(open) {
		body.classList.toggle('nav-open', open);
		if (navToggle) {
			navToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
			navToggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
		}
		if (open && nav) {
			var first = nav.querySelector('a, button');
			if (first) setTimeout(function () { first.focus(); }, 300);
		}
	}

	if (navToggle) {
		navToggle.addEventListener('click', function () {
			setNav(!body.classList.contains('nav-open'));
		});
	}
	Array.prototype.forEach.call(doc.querySelectorAll('[data-nav-close]'), function (el) {
		el.addEventListener('click', function () { setNav(false); });
	});
	doc.addEventListener('keydown', function (e) {
		if (e.key === 'Escape' && body.classList.contains('nav-open')) {
			setNav(false);
			if (navToggle) navToggle.focus();
		}
	});
	if (nav) {
		nav.addEventListener('click', function (e) {
			var link = e.target.closest('a');
			if (link && link.getAttribute('href') && link.getAttribute('href').indexOf('#') !== -1) setNav(false);
		});
	}

	window.matchMedia('(min-width: 1241px)').addEventListener('change', function (mq) {
		if (mq.matches) setNav(false);
	});

	/* Scroll reveal ------------------------------------------------------- */
	var revealEls = doc.querySelectorAll('[data-reveal]');
	Array.prototype.forEach.call(revealEls, function (el) {
		var d = el.getAttribute('data-delay');
		if (d) el.style.setProperty('--reveal-delay', d);
	});

	if ('IntersectionObserver' in window && !reduceMotion) {
		var revealObserver = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-visible');
					revealObserver.unobserve(entry.target);
				}
			});
		}, { rootMargin: '0px 0px -8% 0px', threshold: 0.12 });
		Array.prototype.forEach.call(revealEls, function (el) { revealObserver.observe(el); });
	} else {
		Array.prototype.forEach.call(revealEls, function (el) { el.classList.add('is-visible'); });
	}

	/* Process line -------------------------------------------------------- */
	var processEls = doc.querySelectorAll('[data-process]');
	if ('IntersectionObserver' in window) {
		var processObserver = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-visible');
					processObserver.unobserve(entry.target);
				}
			});
		}, { threshold: 0.3 });
		Array.prototype.forEach.call(processEls, function (el) { processObserver.observe(el); });
	}

	/* reCAPTCHA badge: lift scroll-to-top above it ------------------------ */
	function checkRecaptcha() {
		var badge = doc.querySelector('.grecaptcha-badge');
		var visible = false;
		if (badge) {
			var style = window.getComputedStyle(badge);
			visible = style.visibility !== 'hidden' && style.display !== 'none' && badge.offsetHeight > 0;
		}
		body.classList.toggle('has-recaptcha', visible);
		return !!badge;
	}
	if (!checkRecaptcha() && 'MutationObserver' in window) {
		var mo = new MutationObserver(function () {
			if (checkRecaptcha()) mo.disconnect();
		});
		mo.observe(body, { childList: true, subtree: true });
		setTimeout(function () { mo.disconnect(); }, 20000);
	}

	/* Forms: service preselect and inline validation ---------------------- */
	function preselect(slug) {
		if (!slug) return;
		Array.prototype.forEach.call(doc.querySelectorAll('[data-service-select]'), function (select) {
			Array.prototype.forEach.call(select.options, function (opt) {
				if (opt.getAttribute('data-slug') === slug) select.value = opt.value;
			});
		});
	}

	var params = new URLSearchParams(window.location.search);
	preselect(params.get('service'));

	doc.addEventListener('click', function (e) {
		var trigger = e.target.closest('[data-preselect]');
		if (trigger) preselect(trigger.getAttribute('data-preselect'));

		// In-page links to a form: focus the first field after scrolling.
		var link = e.target.closest('a[href^="#"]');
		if (link && link.getAttribute('href').length > 1) {
			var target = doc.getElementById(link.getAttribute('href').slice(1));
			var field = target ? target.querySelector('input:not([type="hidden"]):not([tabindex="-1"])') : null;
			if (field) setTimeout(function () { field.focus({ preventScroll: true }); }, reduceMotion ? 0 : 600);
		}
	});

	Array.prototype.forEach.call(doc.querySelectorAll('.bia-form'), function (form) {
		form.addEventListener('submit', function (e) {
			var firstInvalid = null;
			Array.prototype.forEach.call(form.querySelectorAll('[required]'), function (input) {
				var field = input.closest('.field');
				var valid = input.type === 'checkbox' ? input.checked : input.value.trim() !== '';
				if (valid && input.type === 'email') valid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value.trim());
				if (field) field.classList.toggle('is-invalid', !valid);
				if (!valid && !firstInvalid) firstInvalid = input;
			});
			if (firstInvalid) {
				e.preventDefault();
				firstInvalid.focus();
				return;
			}
			var btn = form.querySelector('button[type="submit"]');
			if (btn) {
				btn.setAttribute('disabled', 'disabled');
				btn.querySelector('span').textContent = 'Sending...';
			}
		});
		form.addEventListener('input', function (e) {
			var field = e.target.closest('.field');
			if (field) field.classList.remove('is-invalid');
		});
	});

	onScroll();
})();
