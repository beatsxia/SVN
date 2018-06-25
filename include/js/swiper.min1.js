/**
 * Swiper 3.0.6
 * Most modern mobile touch slider and framework with hardware accelerated transitions
 * 
 * http://www.idangero.us/swiper/
 * 
 * Copyright 2015, Vladimir Kharlampidi
 * The iDangero.us
 * http://www.idangero.us/
 * 
 * Licensed under MIT
 * 
 * Released on: March 27, 2015
 */
! function() {
	"use strict";

	function e(e) {
		e.fn.swiper = function(t) {
			var a;
			return e(this).each(function() {
				var e = new Swiper(this, t);
				a || (a = e)
			}), a
		}
	}
	window.Swiper = function(e, a) {
		function r() {
			return "horizontal" === h.params.direction
		}

		function s() {
			h.autoplayTimeoutId = setTimeout(function() {
				h.params.loop ? (h.fixLoop(), h._slideNext()) : h.isEnd ? a.autoplayStopOnLast ? h.stopAutoplay() : h._slideTo(0) : h._slideNext()
			}, h.params.autoplay)
		}

		function i(e, t) {
			var a = g(e.target);
			if(!a.is(t))
				if("string" == typeof t) a = a.parents(t);
				else if(t.nodeType) {
				var r;
				return a.parents().each(function(e, a) {
					a === t && (r = t)
				}), r ? t : void 0
			}
			return 0 === a.length ? void 0 : a[0]
		}

		function n(e, t) {
			t = t || {};
			var a = window.MutationObserver || window.WebkitMutationObserver,
				r = new a(function(e) {
					e.forEach(function(e) {
						h.onResize(), h.emit("onObserverUpdate", h, e)
					})
				});
			r.observe(e, {
				attributes: "undefined" == typeof t.attributes ? !0 : t.attributes,
				childList: "undefined" == typeof t.childList ? !0 : t.childList,
				characterData: "undefined" == typeof t.characterData ? !0 : t.characterData
			}), h.observers.push(r)
		}

		function o(e) {
			e.originalEvent && (e = e.originalEvent);
			var t = e.keyCode || e.charCode;
			if(!(e.shiftKey || e.altKey || e.ctrlKey || e.metaKey || document.activeElement && document.activeElement.nodeName && ("input" === document.activeElement.nodeName.toLowerCase() || "textarea" === document.activeElement.nodeName.toLowerCase()))) {
				if(37 === t || 39 === t || 38 === t || 40 === t) {
					var a = !1;
					if(h.container.parents(".swiper-slide").length > 0 && 0 === h.container.parents(".swiper-slide-active").length) return;
					for(var s = {
							left: window.pageXOffset,
							top: window.pageYOffset
						}, i = window.innerWidth, n = window.innerHeight, o = h.container.offset(), l = [
							[o.left, o.top],
							[o.left + h.width, o.top],
							[o.left, o.top + h.height],
							[o.left + h.width, o.top + h.height]
						], d = 0; d < l.length; d++) {
						var p = l[d];
						p[0] >= s.left && p[0] <= s.left + i && p[1] >= s.top && p[1] <= s.top + n && (a = !0)
					}
					if(!a) return
				}
				r() ? ((37 === t || 39 === t) && (e.preventDefault ? e.preventDefault() : e.returnValue = !1), 39 === t && h.slideNext(), 37 === t && h.slidePrev()) : ((38 === t || 40 === t) && (e.preventDefault ? e.preventDefault() : e.returnValue = !1), 40 === t && h.slideNext(), 38 === t && h.slidePrev())
			}
		}

		function l(e) {
			e.originalEvent && (e = e.originalEvent);
			var t = h._wheelEvent,
				a = 0;
			if(e.detail) a = -e.detail;
			else if("mousewheel" === t)
				if(h.params.mousewheelForceToAxis)
					if(r()) {
						if(!(Math.abs(e.wheelDeltaX) > Math.abs(e.wheelDeltaY))) return;
						a = e.wheelDeltaX
					} else {
						if(!(Math.abs(e.wheelDeltaY) > Math.abs(e.wheelDeltaX))) return;
						a = e.wheelDeltaY
					}
			else a = e.wheelDelta;
			else if("DOMMouseScroll" === t) a = -e.detail;
			else if("wheel" === t)
				if(h.params.mousewheelForceToAxis)
					if(r()) {
						if(!(Math.abs(e.deltaX) > Math.abs(e.deltaY))) return;
						a = -e.deltaX
					} else {
						if(!(Math.abs(e.deltaY) > Math.abs(e.deltaX))) return;
						a = -e.deltaY
					}
			else a = Math.abs(e.deltaX) > Math.abs(e.deltaY) ? -e.deltaX : -e.deltaY;
			if(h.params.freeMode) {
				var s = h.getWrapperTranslate() + a;
				if(s > 0 && (s = 0), s < h.maxTranslate() && (s = h.maxTranslate()), h.setWrapperTransition(0), h.setWrapperTranslate(s), h.updateProgress(), h.updateActiveIndex(), 0 === s || s === h.maxTranslate()) return
			} else(new Date).getTime() - h._lastWheelScrollTime > 60 && (0 > a ? h.slideNext() : h.slidePrev()), h._lastWheelScrollTime = (new Date).getTime();
			return h.params.autoplay && h.stopAutoplay(), e.preventDefault ? e.preventDefault() : e.returnValue = !1, !1
		}

		function d(e, t) {
			e = g(e);
			var a, s, i;
			a = e.attr("data-swiper-parallax") || "0", s = e.attr("data-swiper-parallax-x"), i = e.attr("data-swiper-parallax-y"), s || i ? (s = s || "0", i = i || "0") : r() ? (s = a, i = "0") : (i = a, s = "0"), s = s.indexOf("%") >= 0 ? parseInt(s, 10) * t + "%" : s * t + "px", i = i.indexOf("%") >= 0 ? parseInt(i, 10) * t + "%" : i * t + "px", e.transform("translate3d(" + s + ", " + i + ",0px)")
		}

		function p(e) {
			return 0 !== e.indexOf("on") && (e = e[0] !== e[0].toUpperCase() ? "on" + e[0].toUpperCase() + e.substring(1) : "on" + e), e
		}
		if(!(this instanceof Swiper)) return new Swiper(e, a);
		var u = {
				direction: "horizontal",
				touchEventsTarget: "container",
				initialSlide: 0,
				speed: 300,
				autoplay: !1,
				autoplayDisableOnInteraction: !0,
				freeMode: !1,
				freeModeMomentum: !0,
				freeModeMomentumRatio: 1,
				freeModeMomentumBounce: !0,
				freeModeMomentumBounceRatio: 1,
				setWrapperSize: !1,
				virtualTranslate: !1,
				effect: "slide",
				coverflow: {
					rotate: 50,
					stretch: 0,
					depth: 100,
					modifier: 1,
					slideShadows: !0
				},
				cube: {
					slideShadows: !0,
					shadow: !0,
					shadowOffset: 20,
					shadowScale: .94
				},
				fade: {
					crossFade: !1
				},
				parallax: !1,
				scrollbar: null,
				scrollbarHide: !0,
				keyboardControl: !1,
				mousewheelControl: !1,
				mousewheelForceToAxis: !1,
				hashnav: !1,
				spaceBetween: 0,
				slidesPerView: 1,
				slidesPerColumn: 1,
				slidesPerColumnFill: "column",
				slidesPerGroup: 1,
				centeredSlides: !1,
				touchRatio: 1,
				touchAngle: 45,
				simulateTouch: !0,
				shortSwipes: !0,
				longSwipes: !0,
				longSwipesRatio: .5,
				longSwipesMs: 300,
				followFinger: !0,
				onlyExternal: !1,
				threshold: 0,
				touchMoveStopPropagation: !0,
				pagination: null,
				paginationClickable: !1,
				paginationHide: !1,
				paginationBulletRender: null,
				resistance: !0,
				resistanceRatio: .85,
				nextButton: null,
				prevButton: null,
				watchSlidesProgress: !1,
				watchSlidesVisibility: !1,
				grabCursor: !1,
				preventClicks: !0,
				preventClicksPropagation: !0,
				slideToClickedSlide: !1,
				lazyLoading: !1,
				lazyLoadingInPrevNext: !1,
				lazyLoadingOnTransitionStart: !1,
				preloadImages: !0,
				updateOnImagesReady: !0,
				loop: !1,
				loopAdditionalSlides: 0,
				loopedSlides: null,
				control: void 0,
				controlInverse: !1,
				allowSwipeToPrev: !0,
				allowSwipeToNext: !0,
				swipeHandler: null,
				noSwiping: !0,
				noSwipingClass: "swiper-no-swiping",
				slideClass: "swiper-slide",
				slideActiveClass: "swiper-slide-active",
				slideVisibleClass: "swiper-slide-visible",
				slideDuplicateClass: "swiper-slide-duplicate",
				slideNextClass: "swiper-slide-next",
				slidePrevClass: "swiper-slide-prev",
				wrapperClass: "swiper-wrapper",
				bulletClass: "swiper-pagination-bullet",
				bulletActiveClass: "swiper-pagination-bullet-active",
				buttonDisabledClass: "swiper-button-disabled",
				paginationHiddenClass: "swiper-pagination-hidden",
				observer: !1,
				observeParents: !1,
				a11y: !1,
				prevSlideMessage: "Previous slide",
				nextSlideMessage: "Next slide",
				firstSlideMessage: "This is the first slide",
				lastSlideMessage: "This is the last slide",
				runCallbacksOnInit: !0
			},
			c = a && a.virtualTranslate;
		a = a || {};
		for(var m in u)
			if("undefined" == typeof a[m]) a[m] = u[m];
			else if("object" == typeof a[m])
			for(var f in u[m]) "undefined" == typeof a[m][f] && (a[m][f] = u[m][f]);
		var h = this;
		h.params = a, h.classNames = [];
		var g;
		if(g = "undefined" == typeof t ? window.Dom7 || window.Zepto || window.jQuery : t, g && (h.$ = g, h.container = g(e), 0 !== h.container.length)) {
			if(h.container.length > 1) return void h.container.each(function() {
				new Swiper(this, a)
			});
			h.container[0].swiper = h, h.container.data("swiper", h), h.classNames.push("swiper-container-" + h.params.direction), h.params.freeMode && h.classNames.push("swiper-container-free-mode"), h.support.flexbox || (h.classNames.push("swiper-container-no-flexbox"), h.params.slidesPerColumn = 1), (h.params.parallax || h.params.watchSlidesVisibility) && (h.params.watchSlidesProgress = !0), ["cube", "coverflow"].indexOf(h.params.effect) >= 0 && (h.support.transforms3d ? (h.params.watchSlidesProgress = !0, h.classNames.push("swiper-container-3d")) : h.params.effect = "slide"), "slide" !== h.params.effect && h.classNames.push("swiper-container-" + h.params.effect), "cube" === h.params.effect && (h.params.resistanceRatio = 0, h.params.slidesPerView = 1, h.params.slidesPerColumn = 1, h.params.slidesPerGroup = 1, h.params.centeredSlides = !1, h.params.spaceBetween = 0, h.params.virtualTranslate = !0, h.params.setWrapperSize = !1), "fade" === h.params.effect && (h.params.slidesPerView = 1, h.params.slidesPerColumn = 1, h.params.slidesPerGroup = 1, h.params.watchSlidesProgress = !0, h.params.spaceBetween = 0, "undefined" == typeof c && (h.params.virtualTranslate = !0)), h.params.grabCursor && h.support.touch && (h.params.grabCursor = !1), h.wrapper = h.container.children("." + h.params.wrapperClass), h.params.pagination && (h.paginationContainer = g(h.params.pagination), h.params.paginationClickable && h.paginationContainer.addClass("swiper-pagination-clickable")), h.rtl = r() && ("rtl" === h.container[0].dir.toLowerCase() || "rtl" === h.container.css("direction")), h.rtl && h.classNames.push("swiper-container-rtl"), h.rtl && (h.wrongRTL = "-webkit-box" === h.wrapper.css("display")), h.params.slidesPerColumn > 1 && h.classNames.push("swiper-container-multirow"), h.device.android && h.classNames.push("swiper-container-android"), h.container.addClass(h.classNames.join(" ")), h.translate = 0, h.progress = 0, h.velocity = 0, h.lockSwipeToNext = function() {
				h.params.allowSwipeToNext = !1
			}, h.lockSwipeToPrev = function() {
				h.params.allowSwipeToPrev = !1
			}, h.lockSwipes = function() {
				h.params.allowSwipeToNext = h.params.allowSwipeToPrev = !1
			}, h.unlockSwipeToNext = function() {
				h.params.allowSwipeToNext = !0
			}, h.unlockSwipeToPrev = function() {
				h.params.allowSwipeToPrev = !0
			}, h.unlockSwipes = function() {
				h.params.allowSwipeToNext = h.params.allowSwipeToPrev = !0
			}, h.params.grabCursor && (h.container[0].style.cursor = "move", h.container[0].style.cursor = "-webkit-grab", h.container[0].style.cursor = "-moz-grab", h.container[0].style.cursor = "grab"), h.imagesToLoad = [], h.imagesLoaded = 0, h.loadImage = function(e, t, a, r) {
				function s() {
					r && r()
				}
				var i;
				e.complete && a ? s() : t ? (i = new Image, i.onload = s, i.onerror = s, i.src = t) : s()
			}, h.preloadImages = function() {
				function e() {
					"undefined" != typeof h && null !== h && (void 0 !== h.imagesLoaded && h.imagesLoaded++, h.imagesLoaded === h.imagesToLoad.length && (h.params.updateOnImagesReady && h.update(), h.emit("onImagesReady", h)))
				}
				h.imagesToLoad = h.container.find("img");
				for(var t = 0; t < h.imagesToLoad.length; t++) h.loadImage(h.imagesToLoad[t], h.imagesToLoad[t].currentSrc || h.imagesToLoad[t].getAttribute("src"), !0, e)
			}, h.autoplayTimeoutId = void 0, h.autoplaying = !1, h.autoplayPaused = !1, h.startAutoplay = function() {
				return "undefined" != typeof h.autoplayTimeoutId ? !1 : h.params.autoplay ? h.autoplaying ? !1 : (h.autoplaying = !0, h.emit("onAutoplayStart", h), void s()) : !1
			}, h.stopAutoplay = function() {
				h.autoplayTimeoutId && (h.autoplayTimeoutId && clearTimeout(h.autoplayTimeoutId), h.autoplaying = !1, h.autoplayTimeoutId = void 0, h.emit("onAutoplayStop", h))
			}, h.pauseAutoplay = function(e) {
				h.autoplayPaused || (h.autoplayTimeoutId && clearTimeout(h.autoplayTimeoutId), h.autoplayPaused = !0, 0 === e ? (h.autoplayPaused = !1, s()) : h.wrapper.transitionEnd(function() {
					h.autoplayPaused = !1, h.autoplaying ? s() : h.stopAutoplay()
				}))
			}, h.minTranslate = function() {
				return -h.snapGrid[0]
			}, h.maxTranslate = function() {
				return -h.snapGrid[h.snapGrid.length - 1]
			}, h.updateContainerSize = function() {
				h.width = h.container[0].clientWidth, h.height = h.container[0].clientHeight, h.size = r() ? h.width : h.height
			}, h.updateSlidesSize = function() {
				h.slides = h.wrapper.children("." + h.params.slideClass), h.snapGrid = [], h.slidesGrid = [], h.slidesSizesGrid = [];
				var e, t = h.params.spaceBetween,
					a = 0,
					s = 0,
					i = 0;
				"string" == typeof t && t.indexOf("%") >= 0 && (t = parseFloat(t.replace("%", "")) / 100 * h.size), h.virtualSize = -t, h.slides.css(h.rtl ? {
					marginLeft: "",
					marginTop: ""
				} : {
					marginRight: "",
					marginBottom: ""
				});
				var n;
				h.params.slidesPerColumn > 1 && (n = Math.floor(h.slides.length / h.params.slidesPerColumn) === h.slides.length / h.params.slidesPerColumn ? h.slides.length : Math.ceil(h.slides.length / h.params.slidesPerColumn) * h.params.slidesPerColumn);
				var o;
				for(e = 0; e < h.slides.length; e++) {
					o = 0;
					var l = h.slides.eq(e);
					if(h.params.slidesPerColumn > 1) {
						var d, p, u, c, m = h.params.slidesPerColumn;
						"column" === h.params.slidesPerColumnFill ? (p = Math.floor(e / m), u = e - p * m, d = p + u * n / m, l.css({
							"-webkit-box-ordinal-group": d,
							"-moz-box-ordinal-group": d,
							"-ms-flex-order": d,
							"-webkit-order": d,
							order: d
						})) : (c = n / m, u = Math.floor(e / c), p = e - u * c), l.css({
							"margin-top": 0 !== u && h.params.spaceBetween && h.params.spaceBetween + "px"
						}).attr("data-swiper-column", p).attr("data-swiper-row", u)
					}
					"none" !== l.css("display") && ("auto" === h.params.slidesPerView ? o = r() ? l.outerWidth(!0) : l.outerHeight(!0) : (o = (h.size - (h.params.slidesPerView - 1) * t) / h.params.slidesPerView, r() ? h.slides[e].style.width = o + "px" : h.slides[e].style.height = o + "px"), h.slides[e].swiperSlideSize = o, h.slidesSizesGrid.push(o), h.params.centeredSlides ? (a = a + o / 2 + s / 2 + t, 0 === e && (a = a - h.size / 2 - t), Math.abs(a) < .001 && (a = 0), i % h.params.slidesPerGroup === 0 && h.snapGrid.push(a), h.slidesGrid.push(a)) : (i % h.params.slidesPerGroup === 0 && h.snapGrid.push(a), h.slidesGrid.push(a), a = a + o + t), h.virtualSize += o + t, s = o, i++)
				}
				h.virtualSize = Math.max(h.virtualSize, h.size);
				var f;
				if(h.rtl && h.wrongRTL && ("slide" === h.params.effect || "coverflow" === h.params.effect) && h.wrapper.css({
						width: h.virtualSize + h.params.spaceBetween + "px"
					}), (!h.support.flexbox || h.params.setWrapperSize) && h.wrapper.css(r() ? {
						width: h.virtualSize + h.params.spaceBetween + "px"
					} : {
						height: h.virtualSize + h.params.spaceBetween + "px"
					}), h.params.slidesPerColumn > 1 && (h.virtualSize = (o + h.params.spaceBetween) * n, h.virtualSize = Math.ceil(h.virtualSize / h.params.slidesPerColumn) - h.params.spaceBetween, h.wrapper.css({
						width: h.virtualSize + h.params.spaceBetween + "px"
					}), h.params.centeredSlides)) {
					for(f = [], e = 0; e < h.snapGrid.length; e++) h.snapGrid[e] < h.virtualSize + h.snapGrid[0] && f.push(h.snapGrid[e]);
					h.snapGrid = f
				}
				if(!h.params.centeredSlides) {
					for(f = [], e = 0; e < h.snapGrid.length; e++) h.snapGrid[e] <= h.virtualSize - h.size && f.push(h.snapGrid[e]);
					h.snapGrid = f, Math.floor(h.virtualSize - h.size) > Math.floor(h.snapGrid[h.snapGrid.length - 1]) && h.snapGrid.push(h.virtualSize - h.size)
				}
				0 === h.snapGrid.length && (h.snapGrid = [0]), 0 !== h.params.spaceBetween && h.slides.css(r() ? h.rtl ? {
					marginLeft: t + "px"
				} : {
					marginRight: t + "px"
				} : {
					marginBottom: t + "px"
				}), h.params.watchSlidesProgress && h.updateSlidesOffset()
			}, h.updateSlidesOffset = function() {
				for(var e = 0; e < h.slides.length; e++) h.slides[e].swiperSlideOffset = r() ? h.slides[e].offsetLeft : h.slides[e].offsetTop
			}, h.updateSlidesProgress = function(e) {
				if("undefined" == typeof e && (e = h.translate || 0), 0 !== h.slides.length) {
					"undefined" == typeof h.slides[0].swiperSlideOffset && h.updateSlidesOffset();
					var t = h.params.centeredSlides ? -e + h.size / 2 : -e;
					h.rtl && (t = h.params.centeredSlides ? e - h.size / 2 : e); {
						h.container[0].getBoundingClientRect(), r() ? "left" : "top", r() ? "right" : "bottom"
					}
					h.slides.removeClass(h.params.slideVisibleClass);
					for(var a = 0; a < h.slides.length; a++) {
						var s = h.slides[a],
							i = h.params.centeredSlides === !0 ? s.swiperSlideSize / 2 : 0,
							n = (t - s.swiperSlideOffset - i) / (s.swiperSlideSize + h.params.spaceBetween);
						if(h.params.watchSlidesVisibility) {
							var o = -(t - s.swiperSlideOffset - i),
								l = o + h.slidesSizesGrid[a],
								d = o >= 0 && o < h.size || l > 0 && l <= h.size || 0 >= o && l >= h.size;
							d && h.slides.eq(a).addClass(h.params.slideVisibleClass)
						}
						s.progress = h.rtl ? -n : n
					}
				}
			}, h.updateProgress = function(e) {
				"undefined" == typeof e && (e = h.translate || 0);
				var t = h.maxTranslate() - h.minTranslate();
				0 === t ? (h.progress = 0, h.isBeginning = h.isEnd = !0) : (h.progress = (e - h.minTranslate()) / t, h.isBeginning = h.progress <= 0, h.isEnd = h.progress >= 1), h.isBeginning && h.emit("onReachBeginning", h), h.isEnd && h.emit("onReachEnd", h), h.params.watchSlidesProgress && h.updateSlidesProgress(e), h.emit("onProgress", h, h.progress)
			}, h.updateActiveIndex = function() {
				var e, t, a, r = h.rtl ? h.translate : -h.translate;
				for(t = 0; t < h.slidesGrid.length; t++) "undefined" != typeof h.slidesGrid[t + 1] ? r >= h.slidesGrid[t] && r < h.slidesGrid[t + 1] - (h.slidesGrid[t + 1] - h.slidesGrid[t]) / 2 ? e = t : r >= h.slidesGrid[t] && r < h.slidesGrid[t + 1] && (e = t + 1) : r >= h.slidesGrid[t] && (e = t);
				(0 > e || "undefined" == typeof e) && (e = 0), a = Math.floor(e / h.params.slidesPerGroup), a >= h.snapGrid.length && (a = h.snapGrid.length - 1), e !== h.activeIndex && (h.snapIndex = a, h.previousIndex = h.activeIndex, h.activeIndex = e, h.updateClasses())
			}, h.updateClasses = function() {
				h.slides.removeClass(h.params.slideActiveClass + " " + h.params.slideNextClass + " " + h.params.slidePrevClass);
				var e = h.slides.eq(h.activeIndex);
				if(e.addClass(h.params.slideActiveClass), e.next("." + h.params.slideClass).addClass(h.params.slideNextClass), e.prev("." + h.params.slideClass).addClass(h.params.slidePrevClass), h.bullets && h.bullets.length > 0) {
					h.bullets.removeClass(h.params.bulletActiveClass);
					var t;
					h.params.loop ? (t = Math.ceil(h.activeIndex - h.loopedSlides) / h.params.slidesPerGroup, t > h.slides.length - 1 - 2 * h.loopedSlides && (t -= h.slides.length - 2 * h.loopedSlides), t > h.bullets.length - 1 && (t -= h.bullets.length)) : t = "undefined" != typeof h.snapIndex ? h.snapIndex : h.activeIndex || 0, h.paginationContainer.length > 1 ? h.bullets.each(function() {
						g(this).index() === t && g(this).addClass(h.params.bulletActiveClass)
					}) : h.bullets.eq(t).addClass(h.params.bulletActiveClass)
				}
				h.params.loop || (h.params.prevButton && (h.isBeginning ? (g(h.params.prevButton).addClass(h.params.buttonDisabledClass), h.params.a11y && h.a11y && h.a11y.disable(g(h.params.prevButton))) : (g(h.params.prevButton).removeClass(h.params.buttonDisabledClass), h.params.a11y && h.a11y && h.a11y.enable(g(h.params.prevButton)))), h.params.nextButton && (h.isEnd ? (g(h.params.nextButton).addClass(h.params.buttonDisabledClass), h.params.a11y && h.a11y && h.a11y.disable(g(h.params.nextButton))) : (g(h.params.nextButton).removeClass(h.params.buttonDisabledClass), h.params.a11y && h.a11y && h.a11y.enable(g(h.params.nextButton)))))
			}, h.updatePagination = function() {
				if(h.params.pagination && h.paginationContainer && h.paginationContainer.length > 0) {
					for(var e = "", t = h.params.loop ? Math.ceil((h.slides.length - 2 * h.loopedSlides) / h.params.slidesPerGroup) : h.snapGrid.length, a = 0; t > a; a++) e += h.params.paginationBulletRender ? h.params.paginationBulletRender(a, h.params.bulletClass) : '<span class="' + h.params.bulletClass + '"></span>';
					h.paginationContainer.html(e), h.bullets = h.paginationContainer.find("." + h.params.bulletClass)
				}
			}, h.update = function(e) {
				function t() {
					r = Math.min(Math.max(h.translate, h.maxTranslate()), h.minTranslate()), h.setWrapperTranslate(r), h.updateActiveIndex(), h.updateClasses()
				}
				if(h.updateContainerSize(), h.updateSlidesSize(), h.updateProgress(), h.updatePagination(), h.updateClasses(), h.params.scrollbar && h.scrollbar && h.scrollbar.set(), e) {
					var a, r;
					h.params.freeMode ? t() : (a = "auto" === h.params.slidesPerView && h.isEnd && !h.params.centeredSlides ? h.slideTo(h.slides.length - 1, 0, !1, !0) : h.slideTo(h.activeIndex, 0, !1, !0), a || t())
				}
			}, h.onResize = function() {
				if(h.updateContainerSize(), h.updateSlidesSize(), h.updateProgress(), ("auto" === h.params.slidesPerView || h.params.freeMode) && h.updatePagination(), h.params.scrollbar && h.scrollbar && h.scrollbar.set(), h.params.freeMode) {
					var e = Math.min(Math.max(h.translate, h.maxTranslate()), h.minTranslate());
					h.setWrapperTranslate(e), h.updateActiveIndex(), h.updateClasses()
				} else h.updateClasses(), "auto" === h.params.slidesPerView && h.isEnd && !h.params.centeredSlides ? h.slideTo(h.slides.length - 1, 0, !1, !0) : h.slideTo(h.activeIndex, 0, !1, !0)
			};
			var v = ["mousedown", "mousemove", "mouseup"];
			window.navigator.pointerEnabled ? v = ["pointerdown", "pointermove", "pointerup"] : window.navigator.msPointerEnabled && (v = ["MSPointerDown", "MSPointerMove", "MSPointerUp"]), h.touchEvents = {
				start: h.support.touch || !h.params.simulateTouch ? "touchstart" : v[0],
				move: h.support.touch || !h.params.simulateTouch ? "touchmove" : v[1],
				end: h.support.touch || !h.params.simulateTouch ? "touchend" : v[2]
			}, (window.navigator.pointerEnabled || window.navigator.msPointerEnabled) && ("container" === h.params.touchEventsTarget ? h.container : h.wrapper).addClass("swiper-wp8-" + h.params.direction), h.initEvents = function(e) {
				var t = e ? "off" : "on",
					r = e ? "removeEventListener" : "addEventListener",
					s = "container" === h.params.touchEventsTarget ? h.container[0] : h.wrapper[0],
					i = h.support.touch ? s : document,
					n = h.params.nested ? !0 : !1;
				h.browser.ie ? (s[r](h.touchEvents.start, h.onTouchStart, !1), i[r](h.touchEvents.move, h.onTouchMove, n), i[r](h.touchEvents.end, h.onTouchEnd, !1)) : (h.support.touch && (s[r](h.touchEvents.start, h.onTouchStart, !1), s[r](h.touchEvents.move, h.onTouchMove, n), s[r](h.touchEvents.end, h.onTouchEnd, !1)), !a.simulateTouch || h.device.ios || h.device.android || (s[r]("mousedown", h.onTouchStart, !1), i[r]("mousemove", h.onTouchMove, n), i[r]("mouseup", h.onTouchEnd, !1))), window[r]("resize", h.onResize), h.params.nextButton && (g(h.params.nextButton)[t]("click", h.onClickNext), h.params.a11y && h.a11y && g(h.params.nextButton)[t]("keydown", h.a11y.onEnterKey)), h.params.prevButton && (g(h.params.prevButton)[t]("click", h.onClickPrev), h.params.a11y && h.a11y && g(h.params.prevButton)[t]("keydown", h.a11y.onEnterKey)), h.params.pagination && h.params.paginationClickable && g(h.paginationContainer)[t]("click", "." + h.params.bulletClass, h.onClickIndex), (h.params.preventClicks || h.params.preventClicksPropagation) && s[r]("click", h.preventClicks, !0)
			}, h.attachEvents = function() {
				h.initEvents()
			}, h.detachEvents = function() {
				h.initEvents(!0)
			}, h.allowClick = !0, h.preventClicks = function(e) {
				h.allowClick || (h.params.preventClicks && e.preventDefault(), h.params.preventClicksPropagation && (e.stopPropagation(), e.stopImmediatePropagation()))
			}, h.onClickNext = function(e) {
				e.preventDefault(), h.slideNext()
			}, h.onClickPrev = function(e) {
				e.preventDefault(), h.slidePrev()
			}, h.onClickIndex = function(e) {
				e.preventDefault();
				var t = g(this).index() * h.params.slidesPerGroup;
				h.params.loop && (t += h.loopedSlides), h.slideTo(t)
			}, h.updateClickedSlide = function(e) {
				var t = i(e, "." + h.params.slideClass);
				if(!t) return h.clickedSlide = void 0, void(h.clickedIndex = void 0);
				if(h.clickedSlide = t, h.clickedIndex = g(t).index(), h.params.slideToClickedSlide && void 0 !== h.clickedIndex && h.clickedIndex !== h.activeIndex) {
					var a, r = h.clickedIndex;
					if(h.params.loop)
						if(a = g(h.clickedSlide).attr("data-swiper-slide-index"), r > h.slides.length - h.params.slidesPerView) h.fixLoop(), r = h.wrapper.children("." + h.params.slideClass + '[data-swiper-slide-index="' + a + '"]').eq(0).index(), setTimeout(function() {
							h.slideTo(r)
						}, 0);
						else if(r < h.params.slidesPerView - 1) {
						h.fixLoop();
						var s = h.wrapper.children("." + h.params.slideClass + '[data-swiper-slide-index="' + a + '"]');
						r = s.eq(s.length - 1).index(), setTimeout(function() {
							h.slideTo(r)
						}, 0)
					} else h.slideTo(r);
					else h.slideTo(r)
				}
			};
			var w, y, b, x, T, S, C, M, E, z = "input, select, textarea, button",
				P = Date.now(),
				I = [];
			h.animating = !1, h.touches = {
				startX: 0,
				startY: 0,
				currentX: 0,
				currentY: 0,
				diff: 0
			};
			var k, L;
			if(h.onTouchStart = function(e) {
					if(e.originalEvent && (e = e.originalEvent), k = "touchstart" === e.type, k || !("which" in e) || 3 !== e.which) {
						if(h.params.noSwiping && i(e, "." + h.params.noSwipingClass)) return void(h.allowClick = !0);
						if(!h.params.swipeHandler || i(e, h.params.swipeHandler)) {
							if(w = !0, y = !1, x = void 0, L = void 0, h.touches.startX = h.touches.currentX = "touchstart" === e.type ? e.targetTouches[0].pageX : e.pageX, h.touches.startY = h.touches.currentY = "touchstart" === e.type ? e.targetTouches[0].pageY : e.pageY, b = Date.now(), h.allowClick = !0, h.updateContainerSize(), h.swipeDirection = void 0, h.params.threshold > 0 && (C = !1), "touchstart" !== e.type) {
								var t = !0;
								g(e.target).is(z) && (t = !1), document.activeElement && g(document.activeElement).is(z) && document.activeElement.blur(), t && e.preventDefault()
							}
							h.emit("onTouchStart", h, e)
						}
					}
				}, h.onTouchMove = function(e) {
					if(e.originalEvent && (e = e.originalEvent), !(k && "mousemove" === e.type || e.preventedByNestedSwiper)) {
						if(h.params.onlyExternal) return y = !0, void(h.allowClick = !1);
						if(k && document.activeElement && e.target === document.activeElement && g(e.target).is(z)) return y = !0, void(h.allowClick = !1);
						if(h.emit("onTouchMove", h, e), !(e.targetTouches && e.targetTouches.length > 1)) {
							if(h.touches.currentX = "touchmove" === e.type ? e.targetTouches[0].pageX : e.pageX, h.touches.currentY = "touchmove" === e.type ? e.targetTouches[0].pageY : e.pageY, "undefined" == typeof x) {
								var t = 180 * Math.atan2(Math.abs(h.touches.currentY - h.touches.startY), Math.abs(h.touches.currentX - h.touches.startX)) / Math.PI;
								x = r() ? t > h.params.touchAngle : 90 - t > h.params.touchAngle
							}
							if(x && h.emit("onTouchMoveOpposite", h, e), "undefined" == typeof L && h.browser.ieTouch && (h.touches.currentX !== h.touches.startX || h.touches.currentY !== h.touches.startY) && (L = !0), w) {
								if(x) return void(w = !1);
								if(L || !h.browser.ieTouch) {
									h.allowClick = !1, h.emit("onSliderMove", h, e), e.preventDefault(), h.params.touchMoveStopPropagation && !h.params.nested && e.stopPropagation(), y || (a.loop && h.fixLoop(), S = h.getWrapperTranslate(), h.setWrapperTransition(0), h.animating && h.wrapper.trigger("webkitTransitionEnd transitionend oTransitionEnd MSTransitionEnd msTransitionEnd"), h.params.autoplay && h.autoplaying && (h.params.autoplayDisableOnInteraction ? h.stopAutoplay() : h.pauseAutoplay()), E = !1, h.params.grabCursor && (h.container[0].style.cursor = "move", h.container[0].style.cursor = "-webkit-grabbing", h.container[0].style.cursor = "-moz-grabbin", h.container[0].style.cursor = "grabbing")), y = !0;
									var s = h.touches.diff = r() ? h.touches.currentX - h.touches.startX : h.touches.currentY - h.touches.startY;
									s *= h.params.touchRatio, h.rtl && (s = -s), h.swipeDirection = s > 0 ? "prev" : "next", T = s + S;
									var i = !0;
									if(s > 0 && T > h.minTranslate() ? (i = !1, h.params.resistance && (T = h.minTranslate() - 1 + Math.pow(-h.minTranslate() + S + s, h.params.resistanceRatio))) : 0 > s && T < h.maxTranslate() && (i = !1, h.params.resistance && (T = h.maxTranslate() + 1 - Math.pow(h.maxTranslate() - S - s, h.params.resistanceRatio))), i && (e.preventedByNestedSwiper = !0), !h.params.allowSwipeToNext && "next" === h.swipeDirection && S > T && (T = S), !h.params.allowSwipeToPrev && "prev" === h.swipeDirection && T > S && (T = S), h.params.followFinger) {
										if(h.params.threshold > 0) {
											if(!(Math.abs(s) > h.params.threshold || C)) return void(T = S);
											if(!C) return C = !0, h.touches.startX = h.touches.currentX, h.touches.startY = h.touches.currentY, T = S, void(h.touches.diff = r() ? h.touches.currentX - h.touches.startX : h.touches.currentY - h.touches.startY)
										}(h.params.freeMode || h.params.watchSlidesProgress) && h.updateActiveIndex(), h.params.freeMode && (0 === I.length && I.push({
											position: h.touches[r() ? "startX" : "startY"],
											time: b
										}), I.push({
											position: h.touches[r() ? "currentX" : "currentY"],
											time: (new Date).getTime()
										})), h.updateProgress(T), h.setWrapperTranslate(T)
									}
								}
							}
						}
					}
				}, h.onTouchEnd = function(e) {
					if(e.originalEvent && (e = e.originalEvent), h.emit("onTouchEnd", h, e), w) {
						h.params.grabCursor && y && w && (h.container[0].style.cursor = "move", h.container[0].style.cursor = "-webkit-grab", h.container[0].style.cursor = "-moz-grab", h.container[0].style.cursor = "grab");
						var t = Date.now(),
							a = t - b;
						if(h.allowClick && (h.updateClickedSlide(e), h.emit("onTap", h, e), 300 > a && t - P > 300 && (M && clearTimeout(M), M = setTimeout(function() {
								h && (h.params.paginationHide && h.paginationContainer.length > 0 && !g(e.target).hasClass(h.params.bulletClass) && h.paginationContainer.toggleClass(h.params.paginationHiddenClass), h.emit("onClick", h, e))
							}, 300)), 300 > a && 300 > t - P && (M && clearTimeout(M), h.emit("onDoubleTap", h, e))), P = Date.now(), setTimeout(function() {
								h && h.allowClick && (h.allowClick = !0)
							}, 0), !w || !y || !h.swipeDirection || 0 === h.touches.diff || T === S) return void(w = y = !1);
						w = y = !1;
						var r;
						if(r = h.params.followFinger ? h.rtl ? h.translate : -h.translate : -T, h.params.freeMode) {
							if(r < -h.minTranslate()) return void h.slideTo(h.activeIndex);
							if(r > -h.maxTranslate()) return void h.slideTo(h.slides.length - 1);
							if(h.params.freeModeMomentum) {
								if(I.length > 1) {
									var s = I.pop(),
										i = I.pop(),
										n = s.position - i.position,
										o = s.time - i.time;
									h.velocity = n / o, h.velocity = h.velocity / 2, Math.abs(h.velocity) < .02 && (h.velocity = 0), (o > 150 || (new Date).getTime() - s.time > 300) && (h.velocity = 0)
								} else h.velocity = 0;
								I.length = 0;
								var l = 1e3 * h.params.freeModeMomentumRatio,
									d = h.velocity * l,
									p = h.translate + d;
								h.rtl && (p = -p);
								var u, c = !1,
									m = 20 * Math.abs(h.velocity) * h.params.freeModeMomentumBounceRatio;
								p < h.maxTranslate() && (h.params.freeModeMomentumBounce ? (p + h.maxTranslate() < -m && (p = h.maxTranslate() - m), u = h.maxTranslate(), c = !0, E = !0) : p = h.maxTranslate()), p > h.minTranslate() && (h.params.freeModeMomentumBounce ? (p - h.minTranslate() > m && (p = h.minTranslate() + m), u = h.minTranslate(), c = !0, E = !0) : p = h.minTranslate()), 0 !== h.velocity && (l = Math.abs(h.rtl ? (-p - h.translate) / h.velocity : (p - h.translate) / h.velocity)), h.params.freeModeMomentumBounce && c ? (h.updateProgress(u), h.setWrapperTransition(l), h.setWrapperTranslate(p), h.onTransitionStart(), h.animating = !0, h.wrapper.transitionEnd(function() {
									E && (h.emit("onMomentumBounce", h), h.setWrapperTransition(h.params.speed), h.setWrapperTranslate(u), h.wrapper.transitionEnd(function() {
										h.onTransitionEnd()
									}))
								})) : h.velocity ? (h.updateProgress(p), h.setWrapperTransition(l), h.setWrapperTranslate(p), h.onTransitionStart(), h.animating || (h.animating = !0, h.wrapper.transitionEnd(function() {
									h.onTransitionEnd()
								}))) : h.updateProgress(p), h.updateActiveIndex()
							}
							return void((!h.params.freeModeMomentum || a >= h.params.longSwipesMs) && (h.updateProgress(), h.updateActiveIndex()))
						}
						var f, v = 0,
							x = h.slidesSizesGrid[0];
						for(f = 0; f < h.slidesGrid.length; f += h.params.slidesPerGroup) "undefined" != typeof h.slidesGrid[f + h.params.slidesPerGroup] ? r >= h.slidesGrid[f] && r < h.slidesGrid[f + h.params.slidesPerGroup] && (v = f, x = h.slidesGrid[f + h.params.slidesPerGroup] - h.slidesGrid[f]) : r >= h.slidesGrid[f] && (v = f, x = h.slidesGrid[h.slidesGrid.length - 1] - h.slidesGrid[h.slidesGrid.length - 2]);
						var C = (r - h.slidesGrid[v]) / x;
						if(a > h.params.longSwipesMs) {
							if(!h.params.longSwipes) return void h.slideTo(h.activeIndex);
							"next" === h.swipeDirection && h.slideTo(C >= h.params.longSwipesRatio ? v + h.params.slidesPerGroup : v), "prev" === h.swipeDirection && h.slideTo(C > 1 - h.params.longSwipesRatio ? v + h.params.slidesPerGroup : v)
						} else {
							if(!h.params.shortSwipes) return void h.slideTo(h.activeIndex);
							"next" === h.swipeDirection && h.slideTo(v + h.params.slidesPerGroup), "prev" === h.swipeDirection && h.slideTo(v)
						}
					}
				}, h._slideTo = function(e, t) {
					return h.slideTo(e, t, !0, !0)
				}, h.slideTo = function(e, t, a, s) {
					"undefined" == typeof a && (a = !0), "undefined" == typeof e && (e = 0), 0 > e && (e = 0), h.snapIndex = Math.floor(e / h.params.slidesPerGroup), h.snapIndex >= h.snapGrid.length && (h.snapIndex = h.snapGrid.length - 1);
					var i = -h.snapGrid[h.snapIndex];
					h.params.autoplay && h.autoplaying && (s || !h.params.autoplayDisableOnInteraction ? h.pauseAutoplay(t) : h.stopAutoplay()), h.updateProgress(i);
					for(var n = 0; n < h.slidesGrid.length; n++) - i >= h.slidesGrid[n] && (e = n);
					if("undefined" == typeof t && (t = h.params.speed), h.previousIndex = h.activeIndex || 0, h.activeIndex = e, i === h.translate) return h.updateClasses(), !1;
					h.onTransitionStart(a);
					r() ? i : 0, r() ? 0 : i;
					return 0 === t ? (h.setWrapperTransition(0), h.setWrapperTranslate(i), h.onTransitionEnd(a)) : (h.setWrapperTransition(t), h.setWrapperTranslate(i), h.animating || (h.animating = !0, h.wrapper.transitionEnd(function() {
						h.onTransitionEnd(a)
					}))), h.updateClasses(), !0
				}, h.onTransitionStart = function(e) {
					"undefined" == typeof e && (e = !0), h.lazy && h.lazy.onTransitionStart(), e && (h.emit("onTransitionStart", h), h.activeIndex !== h.previousIndex && h.emit("onSlideChangeStart", h))
				}, h.onTransitionEnd = function(e) {
					h.animating = !1, h.setWrapperTransition(0), "undefined" == typeof e && (e = !0), h.lazy && h.lazy.onTransitionEnd(), e && (h.emit("onTransitionEnd", h), h.activeIndex !== h.previousIndex && h.emit("onSlideChangeEnd", h)), h.params.hashnav && h.hashnav && h.hashnav.setHash()
				}, h.slideNext = function(e, t, a) {
					if(h.params.loop) {
						if(h.animating) return !1;
						h.fixLoop(); {
							h.container[0].clientLeft
						}
						return h.slideTo(h.activeIndex + h.params.slidesPerGroup, t, e, a)
					}
					return h.slideTo(h.activeIndex + h.params.slidesPerGroup, t, e, a)
				}, h._slideNext = function(e) {
					return h.slideNext(!0, e, !0)
				}, h.slidePrev = function(e, t, a) {
					if(h.params.loop) {
						if(h.animating) return !1;
						h.fixLoop(); {
							h.container[0].clientLeft
						}
						return h.slideTo(h.activeIndex - 1, t, e, a)
					}
					return h.slideTo(h.activeIndex - 1, t, e, a)
				}, h._slidePrev = function(e) {
					return h.slidePrev(!0, e, !0)
				}, h.slideReset = function(e, t) {
					return h.slideTo(h.activeIndex, t, e)
				}, h.setWrapperTransition = function(e, t) {
					h.wrapper.transition(e), "slide" !== h.params.effect && h.effects[h.params.effect] && h.effects[h.params.effect].setTransition(e), h.params.parallax && h.parallax && h.parallax.setTransition(e), h.params.scrollbar && h.scrollbar && h.scrollbar.setTransition(e), h.params.control && h.controller && h.controller.setTransition(e, t), h.emit("onSetTransition", h, e)
				}, h.setWrapperTranslate = function(e, t, a) {
					var s = 0,
						i = 0,
						n = 0;
					r() ? s = h.rtl ? -e : e : i = e, h.params.virtualTranslate || h.wrapper.transform(h.support.transforms3d ? "translate3d(" + s + "px, " + i + "px, " + n + "px)" : "translate(" + s + "px, " + i + "px)"), h.translate = r() ? s : i, t && h.updateActiveIndex(), "slide" !== h.params.effect && h.effects[h.params.effect] && h.effects[h.params.effect].setTranslate(h.translate), h.params.parallax && h.parallax && h.parallax.setTranslate(h.translate), h.params.scrollbar && h.scrollbar && h.scrollbar.setTranslate(h.translate), h.params.control && h.controller && h.controller.setTranslate(h.translate, a), h.emit("onSetTranslate", h, h.translate)
				}, h.getTranslate = function(e, t) {
					var a, r, s, i;
					return "undefined" == typeof t && (t = "x"), h.params.virtualTranslate ? h.rtl ? -h.translate : h.translate : (s = window.getComputedStyle(e, null), window.WebKitCSSMatrix ? i = new WebKitCSSMatrix("none" === s.webkitTransform ? "" : s.webkitTransform) : (i = s.MozTransform || s.OTransform || s.MsTransform || s.msTransform || s.transform || s.getPropertyValue("transform").replace("translate(", "matrix(1, 0, 0, 1,"), a = i.toString().split(",")), "x" === t && (r = window.WebKitCSSMatrix ? i.m41 : parseFloat(16 === a.length ? a[12] : a[4])), "y" === t && (r = window.WebKitCSSMatrix ? i.m42 : parseFloat(16 === a.length ? a[13] : a[5])), h.rtl && r && (r = -r), r || 0)
				}, h.getWrapperTranslate = function(e) {
					return "undefined" == typeof e && (e = r() ? "x" : "y"), h.getTranslate(h.wrapper[0], e)
				}, h.observers = [], h.initObservers = function() {
					if(h.params.observeParents)
						for(var e = h.container.parents(), t = 0; t < e.length; t++) n(e[t]);
					n(h.container[0], {
						childList: !1
					}), n(h.wrapper[0], {
						attributes: !1
					})
				}, h.disconnectObservers = function() {
					for(var e = 0; e < h.observers.length; e++) h.observers[e].disconnect();
					h.observers = []
				}, h.createLoop = function() {
					h.wrapper.children("." + h.params.slideClass + "." + h.params.slideDuplicateClass).remove();
					var e = h.wrapper.children("." + h.params.slideClass);
					h.loopedSlides = parseInt(h.params.loopedSlides || h.params.slidesPerView, 10), h.loopedSlides = h.loopedSlides + h.params.loopAdditionalSlides, h.loopedSlides > e.length && (h.loopedSlides = e.length);
					var t, a = [],
						r = [];
					for(e.each(function(t, s) {
							var i = g(this);
							t < h.loopedSlides && r.push(s), t < e.length && t >= e.length - h.loopedSlides && a.push(s), i.attr("data-swiper-slide-index", t)
						}), t = 0; t < r.length; t++) h.wrapper.append(g(r[t].cloneNode(!0)).addClass(h.params.slideDuplicateClass));
					for(t = a.length - 1; t >= 0; t--) h.wrapper.prepend(g(a[t].cloneNode(!0)).addClass(h.params.slideDuplicateClass))
				}, h.destroyLoop = function() {
					h.wrapper.children("." + h.params.slideClass + "." + h.params.slideDuplicateClass).remove(), h.slides.removeAttr("data-swiper-slide-index")
				}, h.fixLoop = function() {
					var e;
					h.activeIndex < h.loopedSlides ? (e = h.slides.length - 3 * h.loopedSlides + h.activeIndex, e += h.loopedSlides, h.slideTo(e, 0, !1, !0)) : ("auto" === h.params.slidesPerView && h.activeIndex >= 2 * h.loopedSlides || h.activeIndex > h.slides.length - 2 * h.params.slidesPerView) && (e = -h.slides.length + h.activeIndex + h.loopedSlides, e += h.loopedSlides, h.slideTo(e, 0, !1, !0))
				}, h.appendSlide = function(e) {
					if(h.params.loop && h.destroyLoop(), "object" == typeof e && e.length)
						for(var t = 0; t < e.length; t++) e[t] && h.wrapper.append(e[t]);
					else h.wrapper.append(e);
					h.params.loop && h.createLoop(), h.params.observer && h.support.observer || h.update(!0)
				}, h.prependSlide = function(e) {
					h.params.loop && h.destroyLoop();
					var t = h.activeIndex + 1;
					if("object" == typeof e && e.length) {
						for(var a = 0; a < e.length; a++) e[a] && h.wrapper.prepend(e[a]);
						t = h.activeIndex + e.length
					} else h.wrapper.prepend(e);
					h.params.loop && h.createLoop(), h.params.observer && h.support.observer || h.update(!0), h.slideTo(t, 0, !1)
				}, h.removeSlide = function(e) {
					h.params.loop && h.destroyLoop();
					var t, a = h.activeIndex;
					if("object" == typeof e && e.length) {
						for(var r = 0; r < e.length; r++) t = e[r], h.slides[t] && h.slides.eq(t).remove(), a > t && a--;
						a = Math.max(a, 0)
					} else t = e, h.slides[t] && h.slides.eq(t).remove(), a > t && a--, a = Math.max(a, 0);
					h.params.observer && h.support.observer || h.update(!0), h.slideTo(a, 0, !1)
				}, h.removeAllSlides = function() {
					for(var e = [], t = 0; t < h.slides.length; t++) e.push(t);
					h.removeSlide(e)
				}, h.effects = {
					fade: {
						fadeIndex: null,
						setTranslate: function() {
							for(var e = 0; e < h.slides.length; e++) {
								var t = h.slides.eq(e),
									a = t[0].swiperSlideOffset,
									s = -a;
								h.params.virtualTranslate || (s -= h.translate);
								var i = 0;
								r() || (i = s, s = 0);
								var n = h.params.fade.crossFade ? Math.max(1 - Math.abs(t[0].progress), 0) : 1 + Math.min(Math.max(t[0].progress, -1), 0);
								n > 0 && 1 > n && (h.effects.fade.fadeIndex = e), t.css({
									opacity: n
								}).transform("translate3d(" + s + "px, " + i + "px, 0px)")
							}
						},
						setTransition: function(e) {
							if(h.slides.transition(e), h.params.virtualTranslate && 0 !== e) {
								var t = null !== h.effects.fade.fadeIndex ? h.effects.fade.fadeIndex : h.activeIndex;
								h.slides.eq(t).transitionEnd(function() {
									for(var e = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"], t = 0; t < e.length; t++) h.wrapper.trigger(e[t])
								})
							}
						}
					},
					cube: {
						setTranslate: function() {
							var e, t = 0;
							h.params.cube.shadow && (r() ? (e = h.wrapper.find(".swiper-cube-shadow"), 0 === e.length && (e = g('<div class="swiper-cube-shadow"></div>'), h.wrapper.append(e)), e.css({
								height: h.width + "px"
							})) : (e = h.container.find(".swiper-cube-shadow"), 0 === e.length && (e = g('<div class="swiper-cube-shadow"></div>'), h.container.append(e))));
							for(var a = 0; a < h.slides.length; a++) {
								var s = h.slides.eq(a),
									i = 90 * a,
									n = Math.floor(i / 360);
								h.rtl && (i = -i, n = Math.floor(-i / 360));
								var o = Math.max(Math.min(s[0].progress, 1), -1),
									l = 0,
									d = 0,
									p = 0;
								a % 4 === 0 ? (l = 4 * -n * h.size, p = 0) : (a - 1) % 4 === 0 ? (l = 0, p = 4 * -n * h.size) : (a - 2) % 4 === 0 ? (l = h.size + 4 * n * h.size, p = h.size) : (a - 3) % 4 === 0 && (l = -h.size, p = 3 * h.size + 4 * h.size * n), h.rtl && (l = -l), r() || (d = l, l = 0);
								var u = "rotateX(" + (r() ? 0 : -i) + "deg) rotateY(" + (r() ? i : 0) + "deg) translate3d(" + l + "px, " + d + "px, " + p + "px)";
								if(1 >= o && o > -1 && (t = 90 * a + 90 * o, h.rtl && (t = 90 * -a - 90 * o)), s.transform(u), h.params.cube.slideShadows) {
									var c = s.find(r() ? ".swiper-slide-shadow-left" : ".swiper-slide-shadow-top"),
										m = s.find(r() ? ".swiper-slide-shadow-right" : ".swiper-slide-shadow-bottom");
									0 === c.length && (c = g('<div class="swiper-slide-shadow-' + (r() ? "left" : "top") + '"></div>'), s.append(c)), 0 === m.length && (m = g('<div class="swiper-slide-shadow-' + (r() ? "right" : "bottom") + '"></div>'), s.append(m)); {
										s[0].progress
									}
									c.length && (c[0].style.opacity = -s[0].progress), m.length && (m[0].style.opacity = s[0].progress)
								}
							}
							if(h.wrapper.css({
									"-webkit-transform-origin": "50% 50% -" + h.size / 2 + "px",
									"-moz-transform-origin": "50% 50% -" + h.size / 2 + "px",
									"-ms-transform-origin": "50% 50% -" + h.size / 2 + "px",
									"transform-origin": "50% 50% -" + h.size / 2 + "px"
								}), h.params.cube.shadow)
								if(r()) e.transform("translate3d(0px, " + (h.width / 2 + h.params.cube.shadowOffset) + "px, " + -h.width / 2 + "px) rotateX(90deg) rotateZ(0deg) scale(" + h.params.cube.shadowScale + ")");
								else {
									var f = Math.abs(t) - 90 * Math.floor(Math.abs(t) / 90),
										v = 1.5 - (Math.sin(2 * f * Math.PI / 360) / 2 + Math.cos(2 * f * Math.PI / 360) / 2),
										w = h.params.cube.shadowScale,
										y = h.params.cube.shadowScale / v,
										b = h.params.cube.shadowOffset;
									e.transform("scale3d(" + w + ", 1, " + y + ") translate3d(0px, " + (h.height / 2 + b) + "px, " + -h.height / 2 / y + "px) rotateX(-90deg)")
								}
							var x = h.isSafari || h.isUiWebView ? -h.size / 2 : 0;
							h.wrapper.transform("translate3d(0px,0," + x + "px) rotateX(" + (r() ? 0 : t) + "deg) rotateY(" + (r() ? -t : 0) + "deg)")
						},
						setTransition: function(e) {
							h.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e), h.params.cube.shadow && !r() && h.container.find(".swiper-cube-shadow").transition(e)
						}
					},
					coverflow: {
						setTranslate: function() {
							for(var e = h.translate, t = r() ? -e + h.width / 2 : -e + h.height / 2, a = r() ? h.params.coverflow.rotate : -h.params.coverflow.rotate, s = h.params.coverflow.depth, i = 0, n = h.slides.length; n > i; i++) {
								var o = h.slides.eq(i),
									l = h.slidesSizesGrid[i],
									d = o[0].swiperSlideOffset,
									p = (t - d - l / 2) / l * h.params.coverflow.modifier,
									u = r() ? a * p : 0,
									c = r() ? 0 : a * p,
									m = -s * Math.abs(p),
									f = r() ? 0 : h.params.coverflow.stretch * p,
									v = r() ? h.params.coverflow.stretch * p : 0;
								Math.abs(v) < .001 && (v = 0), Math.abs(f) < .001 && (f = 0), Math.abs(m) < .001 && (m = 0), Math.abs(u) < .001 && (u = 0), Math.abs(c) < .001 && (c = 0);
								var w = "translate3d(" + v + "px," + f + "px," + m + "px)  rotateX(" + c + "deg) rotateY(" + u + "deg)";
								if(o.transform(w), o[0].style.zIndex = -Math.abs(Math.round(p)) + 1, h.params.coverflow.slideShadows) {
									var y = o.find(r() ? ".swiper-slide-shadow-left" : ".swiper-slide-shadow-top"),
										b = o.find(r() ? ".swiper-slide-shadow-right" : ".swiper-slide-shadow-bottom");
									0 === y.length && (y = g('<div class="swiper-slide-shadow-' + (r() ? "left" : "top") + '"></div>'), o.append(y)), 0 === b.length && (b = g('<div class="swiper-slide-shadow-' + (r() ? "right" : "bottom") + '"></div>'), o.append(b)), y.length && (y[0].style.opacity = p > 0 ? p : 0), b.length && (b[0].style.opacity = -p > 0 ? -p : 0)
								}
							}
							if(h.browser.ie) {
								var x = h.wrapper[0].style;
								x.perspectiveOrigin = t + "px 50%"
							}
						},
						setTransition: function(e) {
							h.slides.transition(e).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(e)
						}
					}
				}, h.lazy = {
					initialImageLoaded: !1,
					loadImageInSlide: function(e) {
						if("undefined" != typeof e && 0 !== h.slides.length) {
							var t = h.slides.eq(e),
								a = t.find("img.swiper-lazy:not(.swiper-lazy-loaded):not(.swiper-lazy-loading)");
							0 !== a.length && a.each(function() {
								var e = g(this);
								e.addClass("swiper-lazy-loading");
								var a = e.attr("data-src");
								h.loadImage(e[0], a, !1, function() {
									e.attr("src", a), e.removeAttr("data-src"), e.addClass("swiper-lazy-loaded").removeClass("swiper-lazy-loading"), t.find(".swiper-lazy-preloader, .preloader").remove(), h.emit("onLazyImageReady", h, t[0], e[0])
								}), h.emit("onLazyImageLoad", h, t[0], e[0])
							})
						}
					},
					load: function() {
						if(h.params.watchSlidesVisibility) h.wrapper.children("." + h.params.slideVisibleClass).each(function() {
							h.lazy.loadImageInSlide(g(this).index())
						});
						else if(h.params.slidesPerView > 1)
							for(var e = h.activeIndex; e < h.activeIndex + h.params.slidesPerView; e++) h.slides[e] && h.lazy.loadImageInSlide(e);
						else h.lazy.loadImageInSlide(h.activeIndex);
						if(h.params.lazyLoadingInPrevNext) {
							var t = h.wrapper.children("." + h.params.slideNextClass);
							t.length > 0 && h.lazy.loadImageInSlide(t.index());
							var a = h.wrapper.children("." + h.params.slidePrevClass);
							a.length > 0 && h.lazy.loadImageInSlide(a.index())
						}
					},
					onTransitionStart: function() {
						h.params.lazyLoading && (h.params.lazyLoadingOnTransitionStart || !h.params.lazyLoadingOnTransitionStart && !h.lazy.initialImageLoaded) && (h.lazy.initialImageLoaded = !0, h.lazy.load())
					},
					onTransitionEnd: function() {
						h.params.lazyLoading && !h.params.lazyLoadingOnTransitionStart && h.lazy.load()
					}
				}, h.scrollbar = {
					set: function() {
						if(h.params.scrollbar) {
							var e = h.scrollbar;
							e.track = g(h.params.scrollbar), e.drag = e.track.find(".swiper-scrollbar-drag"), 0 === e.drag.length && (e.drag = g('<div class="swiper-scrollbar-drag"></div>'), e.track.append(e.drag)), e.drag[0].style.width = "", e.drag[0].style.height = "", e.trackSize = r() ? e.track[0].offsetWidth : e.track[0].offsetHeight, e.divider = h.size / h.virtualSize, e.moveDivider = e.divider * (e.trackSize / h.size), e.dragSize = e.trackSize * e.divider, r() ? e.drag[0].style.width = e.dragSize + "px" : e.drag[0].style.height = e.dragSize + "px", e.track[0].style.display = e.divider >= 1 ? "none" : "", h.params.scrollbarHide && (e.track[0].style.opacity = 0)
						}
					},
					setTranslate: function() {
						if(h.params.scrollbar) {
							var e, t = h.scrollbar,
								a = (h.translate || 0, t.dragSize);
							e = (t.trackSize - t.dragSize) * h.progress, h.rtl && r() ? (e = -e, e > 0 ? (a = t.dragSize - e, e = 0) : -e + t.dragSize > t.trackSize && (a = t.trackSize + e)) : 0 > e ? (a = t.dragSize + e, e = 0) : e + t.dragSize > t.trackSize && (a = t.trackSize - e), r() ? (t.drag.transform(h.support.transforms3d ? "translate3d(" + e + "px, 0, 0)" : "translateX(" + e + "px)"), t.drag[0].style.width = a + "px") : (t.drag.transform(h.support.transforms3d ? "translate3d(0px, " + e + "px, 0)" : "translateY(" + e + "px)"), t.drag[0].style.height = a + "px"), h.params.scrollbarHide && (clearTimeout(t.timeout), t.track[0].style.opacity = 1, t.timeout = setTimeout(function() {
								t.track[0].style.opacity = 0, t.track.transition(400)
							}, 1e3))
						}
					},
					setTransition: function(e) {
						h.params.scrollbar && h.scrollbar.drag.transition(e)
					}
				}, h.controller = {
					setTranslate: function(e, t) {
						var a, r, s = h.params.control;
						if(h.isArray(s))
							for(var i = 0; i < s.length; i++) s[i] !== t && s[i] instanceof Swiper && (e = s[i].rtl && "horizontal" === s[i].params.direction ? -h.translate : h.translate, a = (s[i].maxTranslate() - s[i].minTranslate()) / (h.maxTranslate() - h.minTranslate()), r = (e - h.minTranslate()) * a + s[i].minTranslate(), h.params.controlInverse && (r = s[i].maxTranslate() - r), s[i].updateProgress(r), s[i].setWrapperTranslate(r, !1, h), s[i].updateActiveIndex());
						else s instanceof Swiper && t !== s && (e = s.rtl && "horizontal" === s.params.direction ? -h.translate : h.translate, a = (s.maxTranslate() - s.minTranslate()) / (h.maxTranslate() - h.minTranslate()), r = (e - h.minTranslate()) * a + s.minTranslate(), h.params.controlInverse && (r = s.maxTranslate() - r), s.updateProgress(r), s.setWrapperTranslate(r, !1, h), s.updateActiveIndex())
					},
					setTransition: function(e, t) {
						var a = h.params.control;
						if(h.isArray(a))
							for(var r = 0; r < a.length; r++) a[r] !== t && a[r] instanceof Swiper && a[r].setWrapperTransition(e, h);
						else a instanceof Swiper && t !== a && a.setWrapperTransition(e, h)
					}
				}, h.hashnav = {
					init: function() {
						if(h.params.hashnav) {
							h.hashnav.initialized = !0;
							var e = document.location.hash.replace("#", "");
							if(e)
								for(var t = 0, a = 0, r = h.slides.length; r > a; a++) {
									var s = h.slides.eq(a),
										i = s.attr("data-hash");
									if(i === e && !s.hasClass(h.params.slideDuplicateClass)) {
										var n = s.index();
										h.slideTo(n, t, h.params.runCallbacksOnInit, !0)
									}
								}
						}
					},
					setHash: function() {
						h.hashnav.initialized && h.params.hashnav && (document.location.hash = h.slides.eq(h.activeIndex).attr("data-hash") || "")
					}
				}, h.disableKeyboardControl = function() {
					g(document).off("keydown", o)
				}, h.enableKeyboardControl = function() {
					g(document).on("keydown", o)
				}, h._wheelEvent = !1, h._lastWheelScrollTime = (new Date).getTime(), h.params.mousewheelControl) {
				if(void 0 !== document.onmousewheel && (h._wheelEvent = "mousewheel"), !h._wheelEvent) try {
					new WheelEvent("wheel"), h._wheelEvent = "wheel"
				} catch(D) {}
				h._wheelEvent || (h._wheelEvent = "DOMMouseScroll")
			}
			h.disableMousewheelControl = function() {
				return h._wheelEvent ? (h.container.off(h._wheelEvent, l), !0) : !1
			}, h.enableMousewheelControl = function() {
				return h._wheelEvent ? (h.container.on(h._wheelEvent, l), !0) : !1
			}, h.parallax = {
				setTranslate: function() {
					h.container.children("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function() {
						d(this, h.progress)
					}), h.slides.each(function() {
						var e = g(this);
						e.find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function() {
							var t = Math.min(Math.max(e[0].progress, -1), 1);
							d(this, t)
						})
					})
				},
				setTransition: function(e) {
					"undefined" == typeof e && (e = h.params.speed), h.container.find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function() {
						var t = g(this),
							a = parseInt(t.attr("data-swiper-parallax-duration"), 10) || e;
						0 === e && (a = 0), t.transition(a)
					})
				}
			}, h._plugins = [];
			for(var B in h.plugins) {
				var A = h.plugins[B](h, h.params[B]);
				A && h._plugins.push(A)
			}
			return h.callPlugins = function(e) {
				for(var t = 0; t < h._plugins.length; t++) e in h._plugins[t] && h._plugins[t][e](arguments[1], arguments[2], arguments[3], arguments[4], arguments[5])
			}, h.emitterEventListeners = {}, h.emit = function(e) {
				h.params[e] && h.params[e](arguments[1], arguments[2], arguments[3], arguments[4], arguments[5]);
				var t;
				if(h.emitterEventListeners[e])
					for(t = 0; t < h.emitterEventListeners[e].length; t++) h.emitterEventListeners[e][t](arguments[1], arguments[2], arguments[3], arguments[4], arguments[5]);
				h.callPlugins && h.callPlugins(e, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5])
			}, h.on = function(e, t) {
				return e = p(e), h.emitterEventListeners[e] || (h.emitterEventListeners[e] = []), h.emitterEventListeners[e].push(t), h
			}, h.off = function(e, t) {
				var a;
				if(e = p(e), "undefined" == typeof t) return h.emitterEventListeners[e] = [], h;
				if(h.emitterEventListeners[e] && 0 !== h.emitterEventListeners[e].length) {
					for(a = 0; a < h.emitterEventListeners[e].length; a++) h.emitterEventListeners[e][a] === t && h.emitterEventListeners[e].splice(a, 1);
					return h
				}
			}, h.once = function(e, t) {
				e = p(e);
				var a = function() {
					t(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4]), h.off(e, a)
				};
				return h.on(e, a), h
			}, h.a11y = {
				makeFocusable: function(e) {
					return e[0].tabIndex = "0", e
				},
				addRole: function(e, t) {
					return e.attr("role", t), e
				},
				addLabel: function(e, t) {
					return e.attr("aria-label", t), e
				},
				disable: function(e) {
					return e.attr("aria-disabled", !0), e
				},
				enable: function(e) {
					return e.attr("aria-disabled", !1), e
				},
				onEnterKey: function(e) {
					13 === e.keyCode && (g(e.target).is(h.params.nextButton) ? (h.onClickNext(e), h.a11y.notify(h.isEnd ? h.params.lastSlideMsg : h.params.nextSlideMsg)) : g(e.target).is(h.params.prevButton) && (h.onClickPrev(e), h.a11y.notify(h.isBeginning ? h.params.firstSlideMsg : h.params.prevSlideMsg)))
				},
				liveRegion: g('<span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>'),
				notify: function(e) {
					var t = h.a11y.liveRegion;
					0 !== t.length && (t.html(""), t.html(e))
				},
				init: function() {
					if(h.params.nextButton) {
						var e = g(h.params.nextButton);
						h.a11y.makeFocusable(e), h.a11y.addRole(e, "button"), h.a11y.addLabel(e, h.params.nextSlideMsg)
					}
					if(h.params.prevButton) {
						var t = g(h.params.prevButton);
						h.a11y.makeFocusable(t), h.a11y.addRole(t, "button"), h.a11y.addLabel(t, h.params.prevSlideMsg)
					}
					g(h.container).append(h.a11y.liveRegion)
				},
				destroy: function() {
					h.a11y.liveRegion && h.a11y.liveRegion.length > 0 && h.a11y.liveRegion.remove()
				}
			}, h.init = function() {
				h.params.loop && h.createLoop(), h.updateContainerSize(), h.updateSlidesSize(), h.updatePagination(), h.params.scrollbar && h.scrollbar && h.scrollbar.set(), "slide" !== h.params.effect && h.effects[h.params.effect] && (h.params.loop || h.updateProgress(), h.effects[h.params.effect].setTranslate()), h.params.loop ? h.slideTo(h.params.initialSlide + h.loopedSlides, 0, h.params.runCallbacksOnInit) : (h.slideTo(h.params.initialSlide, 0, h.params.runCallbacksOnInit), 0 === h.params.initialSlide && (h.parallax && h.params.parallax && h.parallax.setTranslate(), h.lazy && h.params.lazyLoading && h.lazy.load())), h.attachEvents(), h.params.observer && h.support.observer && h.initObservers(), h.params.preloadImages && !h.params.lazyLoading && h.preloadImages(), h.params.autoplay && h.startAutoplay(), h.params.keyboardControl && h.enableKeyboardControl && h.enableKeyboardControl(), h.params.mousewheelControl && h.enableMousewheelControl && h.enableMousewheelControl(), h.params.hashnav && h.hashnav && h.hashnav.init(), h.params.a11y && h.a11y && h.a11y.init(), h.emit("onInit", h)
			}, h.cleanupStyles = function() {
				h.container.removeClass(h.classNames.join(" ")).removeAttr("style"), h.wrapper.removeAttr("style"), h.slides && h.slides.length && h.slides.removeClass([h.params.slideVisibleClass, h.params.slideActiveClass, h.params.slideNextClass, h.params.slidePrevClass].join(" ")).removeAttr("style").removeAttr("data-swiper-column").removeAttr("data-swiper-row"), h.paginationContainer && h.paginationContainer.length && h.paginationContainer.removeClass(h.params.paginationHiddenClass), h.bullets && h.bullets.length && h.bullets.removeClass(h.params.bulletActiveClass), h.params.prevButton && g(h.params.prevButton).removeClass(h.params.buttonDisabledClass), h.params.nextButton && g(h.params.nextButton).removeClass(h.params.buttonDisabledClass), h.params.scrollbar && h.scrollbar && (h.scrollbar.track && h.scrollbar.track.length && h.scrollbar.track.removeAttr("style"), h.scrollbar.drag && h.scrollbar.drag.length && h.scrollbar.drag.removeAttr("style"))
			}, h.destroy = function(e, t) {
				h.detachEvents(), h.stopAutoplay(), h.params.loop && h.destroyLoop(), t && h.cleanupStyles(), h.disconnectObservers(), h.params.keyboardControl && h.disableKeyboardControl && h.disableKeyboardControl(), h.params.mousewheelControl && h.disableMousewheelControl && h.disableMousewheelControl(), h.params.a11y && h.a11y && h.a11y.destroy(), h.emit("onDestroy"), e !== !1 && (h = null)
			}, h.init(), h
		}
	}, Swiper.prototype = {
		isSafari: function() {
			var e = navigator.userAgent.toLowerCase();
			return e.indexOf("safari") >= 0 && e.indexOf("chrome") < 0 && e.indexOf("android") < 0
		}(),
		isUiWebView: /(iPhone|iPod|iPad).*AppleWebKit(?!.*Safari)/i.test(navigator.userAgent),
		isArray: function(e) {
			return "[object Array]" === Object.prototype.toString.apply(e)
		},
		browser: {
			ie: window.navigator.pointerEnabled || window.navigator.msPointerEnabled,
			ieTouch: window.navigator.msPointerEnabled && window.navigator.msMaxTouchPoints > 1 || window.navigator.pointerEnabled && window.navigator.maxTouchPoints > 1
		},
		device: function() {
			var e = navigator.userAgent,
				t = e.match(/(Android);?[\s\/]+([\d.]+)?/),
				a = e.match(/(iPad).*OS\s([\d_]+)/),
				r = (e.match(/(iPod)(.*OS\s([\d_]+))?/), !a && e.match(/(iPhone\sOS)\s([\d_]+)/));
			return {
				ios: a || r || a,
				android: t
			}
		}(),
		support: {
			touch: window.Modernizr && Modernizr.touch === !0 || function() {
				return !!("ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch)
			}(),
			transforms3d: window.Modernizr && Modernizr.csstransforms3d === !0 || function() {
				var e = document.createElement("div").style;
				return "webkitPerspective" in e || "MozPerspective" in e || "OPerspective" in e || "MsPerspective" in e || "perspective" in e
			}(),
			flexbox: function() {
				for(var e = document.createElement("div").style, t = "alignItems webkitAlignItems webkitBoxAlign msFlexAlign mozBoxAlign webkitFlexDirection msFlexDirection mozBoxDirection mozBoxOrient webkitBoxDirection webkitBoxOrient".split(" "), a = 0; a < t.length; a++)
					if(t[a] in e) return !0
			}(),
			observer: function() {
				return "MutationObserver" in window || "WebkitMutationObserver" in window
			}()
		},
		plugins: {}
	};
	for(var t = (function() {
			var e = function(e) {
					var t = this,
						a = 0;
					for(a = 0; a < e.length; a++) t[a] = e[a];
					return t.length = e.length, this
				},
				t = function(t, a) {
					var r = [],
						s = 0;
					if(t && !a && t instanceof e) return t;
					if(t)
						if("string" == typeof t) {
							var i, n, o = t.trim();
							if(o.indexOf("<") >= 0 && o.indexOf(">") >= 0) {
								var l = "div";
								for(0 === o.indexOf("<li") && (l = "ul"), 0 === o.indexOf("<tr") && (l = "tbody"), (0 === o.indexOf("<td") || 0 === o.indexOf("<th")) && (l = "tr"), 0 === o.indexOf("<tbody") && (l = "table"), 0 === o.indexOf("<option") && (l = "select"), n = document.createElement(l), n.innerHTML = t, s = 0; s < n.childNodes.length; s++) r.push(n.childNodes[s])
							} else
								for(i = a || "#" !== t[0] || t.match(/[ .<>:~]/) ? (a || document).querySelectorAll(t) : [document.getElementById(t.split("#")[1])], s = 0; s < i.length; s++) i[s] && r.push(i[s])
						} else if(t.nodeType || t === window || t === document) r.push(t);
					else if(t.length > 0 && t[0].nodeType)
						for(s = 0; s < t.length; s++) r.push(t[s]);
					return new e(r)
				};
			return e.prototype = {
				addClass: function(e) {
					if("undefined" == typeof e) return this;
					for(var t = e.split(" "), a = 0; a < t.length; a++)
						for(var r = 0; r < this.length; r++) this[r].classList.add(t[a]);
					return this
				},
				removeClass: function(e) {
					for(var t = e.split(" "), a = 0; a < t.length; a++)
						for(var r = 0; r < this.length; r++) this[r].classList.remove(t[a]);
					return this
				},
				hasClass: function(e) {
					return this[0] ? this[0].classList.contains(e) : !1
				},
				toggleClass: function(e) {
					for(var t = e.split(" "), a = 0; a < t.length; a++)
						for(var r = 0; r < this.length; r++) this[r].classList.toggle(t[a]);
					return this
				},
				attr: function(e, t) {
					if(1 === arguments.length && "string" == typeof e) return this[0] ? this[0].getAttribute(e) : void 0;
					for(var a = 0; a < this.length; a++)
						if(2 === arguments.length) this[a].setAttribute(e, t);
						else
							for(var r in e) this[a][r] = e[r], this[a].setAttribute(r, e[r]);
					return this
				},
				removeAttr: function(e) {
					for(var t = 0; t < this.length; t++) this[t].removeAttribute(e);
					return this
				},
				data: function(e, t) {
					if("undefined" == typeof t) {
						if(this[0]) {
							var a = this[0].getAttribute("data-" + e);
							return a ? a : this[0].dom7ElementDataStorage && e in this[0].dom7ElementDataStorage ? this[0].dom7ElementDataStorage[e] : void 0
						}
						return void 0
					}
					for(var r = 0; r < this.length; r++) {
						var s = this[r];
						s.dom7ElementDataStorage || (s.dom7ElementDataStorage = {}), s.dom7ElementDataStorage[e] = t
					}
					return this
				},
				transform: function(e) {
					for(var t = 0; t < this.length; t++) {
						var a = this[t].style;
						a.webkitTransform = a.MsTransform = a.msTransform = a.MozTransform = a.OTransform = a.transform = e
					}
					return this
				},
				transition: function(e) {
					"string" != typeof e && (e += "ms");
					for(var t = 0; t < this.length; t++) {
						var a = this[t].style;
						a.webkitTransitionDuration = a.MsTransitionDuration = a.msTransitionDuration = a.MozTransitionDuration = a.OTransitionDuration = a.transitionDuration = e
					}
					return this
				},
				on: function(e, a, r, s) {
					function i(e) {
						var s = e.target;
						if(t(s).is(a)) r.call(s, e);
						else
							for(var i = t(s).parents(), n = 0; n < i.length; n++) t(i[n]).is(a) && r.call(i[n], e)
					}
					var n, o, l = e.split(" ");
					for(n = 0; n < this.length; n++)
						if("function" == typeof a || a === !1)
							for("function" == typeof a && (r = arguments[1], s = arguments[2] || !1), o = 0; o < l.length; o++) this[n].addEventListener(l[o], r, s);
						else
							for(o = 0; o < l.length; o++) this[n].dom7LiveListeners || (this[n].dom7LiveListeners = []), this[n].dom7LiveListeners.push({
								listener: r,
								liveListener: i
							}), this[n].addEventListener(l[o], i, s);
					return this
				},
				off: function(e, t, a, r) {
					for(var s = e.split(" "), i = 0; i < s.length; i++)
						for(var n = 0; n < this.length; n++)
							if("function" == typeof t || t === !1) "function" == typeof t && (a = arguments[1], r = arguments[2] || !1), this[n].removeEventListener(s[i], a, r);
							else if(this[n].dom7LiveListeners)
						for(var o = 0; o < this[n].dom7LiveListeners.length; o++) this[n].dom7LiveListeners[o].listener === a && this[n].removeEventListener(s[i], this[n].dom7LiveListeners[o].liveListener, r);
					return this
				},
				once: function(e, t, a, r) {
					function s(n) {
						a(n), i.off(e, t, s, r)
					}
					var i = this;
					"function" == typeof t && (t = !1, a = arguments[1], r = arguments[2]), i.on(e, t, s, r)
				},
				trigger: function(e, t) {
					for(var a = 0; a < this.length; a++) {
						var r;
						try {
							r = new CustomEvent(e, {
								detail: t,
								bubbles: !0,
								cancelable: !0
							})
						} catch(s) {
							r = document.createEvent("Event"), r.initEvent(e, !0, !0), r.detail = t
						}
						this[a].dispatchEvent(r)
					}
					return this
				},
				transitionEnd: function(e) {
					function t(i) {
						if(i.target === this)
							for(e.call(this, i), a = 0; a < r.length; a++) s.off(r[a], t)
					}
					var a, r = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"],
						s = this;
					if(e)
						for(a = 0; a < r.length; a++) s.on(r[a], t);
					return this
				},
				width: function() {
					return this[0] === window ? window.innerWidth : this.length > 0 ? parseFloat(this.css("width")) : null
				},
				outerWidth: function(e) {
					return this.length > 0 ? e ? this[0].offsetWidth + parseFloat(this.css("margin-right")) + parseFloat(this.css("margin-left")) : this[0].offsetWidth : null
				},
				height: function() {
					return this[0] === window ? window.innerHeight : this.length > 0 ? parseFloat(this.css("height")) : null
				},
				outerHeight: function(e) {
					return this.length > 0 ? e ? this[0].offsetHeight + parseFloat(this.css("margin-top")) + parseFloat(this.css("margin-bottom")) : this[0].offsetHeight : null
				},
				offset: function() {
					if(this.length > 0) {
						var e = this[0],
							t = e.getBoundingClientRect(),
							a = document.body,
							r = e.clientTop || a.clientTop || 0,
							s = e.clientLeft || a.clientLeft || 0,
							i = window.pageYOffset || e.scrollTop,
							n = window.pageXOffset || e.scrollLeft;
						return {
							top: t.top + i - r,
							left: t.left + n - s
						}
					}
					return null
				},
				css: function(e, t) {
					var a;
					if(1 === arguments.length) {
						if("string" != typeof e) {
							for(a = 0; a < this.length; a++)
								for(var r in e) this[a].style[r] = e[r];
							return this
						}
						if(this[0]) return window.getComputedStyle(this[0], null).getPropertyValue(e)
					}
					if(2 === arguments.length && "string" == typeof e) {
						for(a = 0; a < this.length; a++) this[a].style[e] = t;
						return this
					}
					return this
				},
				each: function(e) {
					for(var t = 0; t < this.length; t++) e.call(this[t], t, this[t]);
					return this
				},
				html: function(e) {
					if("undefined" == typeof e) return this[0] ? this[0].innerHTML : void 0;
					for(var t = 0; t < this.length; t++) this[t].innerHTML = e;
					return this
				},
				is: function(a) {
					if(!this[0]) return !1;
					var r, s;
					if("string" == typeof a) {
						var i = this[0];
						if(i === document) return a === document;
						if(i === window) return a === window;
						if(i.matches) return i.matches(a);
						if(i.webkitMatchesSelector) return i.webkitMatchesSelector(a);
						if(i.mozMatchesSelector) return i.mozMatchesSelector(a);
						if(i.msMatchesSelector) return i.msMatchesSelector(a);
						for(r = t(a), s = 0; s < r.length; s++)
							if(r[s] === this[0]) return !0;
						return !1
					}
					if(a === document) return this[0] === document;
					if(a === window) return this[0] === window;
					if(a.nodeType || a instanceof e) {
						for(r = a.nodeType ? [a] : a, s = 0; s < r.length; s++)
							if(r[s] === this[0]) return !0;
						return !1
					}
					return !1
				},
				index: function() {
					if(this[0]) {
						for(var e = this[0], t = 0; null !== (e = e.previousSibling);) 1 === e.nodeType && t++;
						return t
					}
					return void 0
				},
				eq: function(t) {
					if("undefined" == typeof t) return this;
					var a, r = this.length;
					return t > r - 1 ? new e([]) : 0 > t ? (a = r + t, new e(0 > a ? [] : [this[a]])) : new e([this[t]])
				},
				append: function(t) {
					var a, r;
					for(a = 0; a < this.length; a++)
						if("string" == typeof t) {
							var s = document.createElement("div");
							for(s.innerHTML = t; s.firstChild;) this[a].appendChild(s.firstChild)
						} else if(t instanceof e)
						for(r = 0; r < t.length; r++) this[a].appendChild(t[r]);
					else this[a].appendChild(t);
					return this
				},
				prepend: function(t) {
					var a, r;
					for(a = 0; a < this.length; a++)
						if("string" == typeof t) {
							var s = document.createElement("div");
							for(s.innerHTML = t, r = s.childNodes.length - 1; r >= 0; r--) this[a].insertBefore(s.childNodes[r], this[a].childNodes[0])
						} else if(t instanceof e)
						for(r = 0; r < t.length; r++) this[a].insertBefore(t[r], this[a].childNodes[0]);
					else this[a].insertBefore(t, this[a].childNodes[0]);
					return this
				},
				insertBefore: function(e) {
					for(var a = t(e), r = 0; r < this.length; r++)
						if(1 === a.length) a[0].parentNode.insertBefore(this[r], a[0]);
						else if(a.length > 1)
						for(var s = 0; s < a.length; s++) a[s].parentNode.insertBefore(this[r].cloneNode(!0), a[s])
				},
				insertAfter: function(e) {
					for(var a = t(e), r = 0; r < this.length; r++)
						if(1 === a.length) a[0].parentNode.insertBefore(this[r], a[0].nextSibling);
						else if(a.length > 1)
						for(var s = 0; s < a.length; s++) a[s].parentNode.insertBefore(this[r].cloneNode(!0), a[s].nextSibling)
				},
				next: function(a) {
					return new e(this.length > 0 ? a ? this[0].nextElementSibling && t(this[0].nextElementSibling).is(a) ? [this[0].nextElementSibling] : [] : this[0].nextElementSibling ? [this[0].nextElementSibling] : [] : [])
				},
				nextAll: function(a) {
					var r = [],
						s = this[0];
					if(!s) return new e([]);
					for(; s.nextElementSibling;) {
						var i = s.nextElementSibling;
						a ? t(i).is(a) && r.push(i) : r.push(i), s = i
					}
					return new e(r)
				},
				prev: function(a) {
					return new e(this.length > 0 ? a ? this[0].previousElementSibling && t(this[0].previousElementSibling).is(a) ? [this[0].previousElementSibling] : [] : this[0].previousElementSibling ? [this[0].previousElementSibling] : [] : [])
				},
				prevAll: function(a) {
					var r = [],
						s = this[0];
					if(!s) return new e([]);
					for(; s.previousElementSibling;) {
						var i = s.previousElementSibling;
						a ? t(i).is(a) && r.push(i) : r.push(i), s = i
					}
					return new e(r)
				},
				parent: function(e) {
					for(var a = [], r = 0; r < this.length; r++) e ? t(this[r].parentNode).is(e) && a.push(this[r].parentNode) : a.push(this[r].parentNode);
					return t(t.unique(a))
				},
				parents: function(e) {
					for(var a = [], r = 0; r < this.length; r++)
						for(var s = this[r].parentNode; s;) e ? t(s).is(e) && a.push(s) : a.push(s), s = s.parentNode;
					return t(t.unique(a))
				},
				find: function(t) {
					for(var a = [], r = 0; r < this.length; r++)
						for(var s = this[r].querySelectorAll(t), i = 0; i < s.length; i++) a.push(s[i]);
					return new e(a)
				},
				children: function(a) {
					for(var r = [], s = 0; s < this.length; s++)
						for(var i = this[s].childNodes, n = 0; n < i.length; n++) a ? 1 === i[n].nodeType && t(i[n]).is(a) && r.push(i[n]) : 1 === i[n].nodeType && r.push(i[n]);
					return new e(t.unique(r))
				},
				remove: function() {
					for(var e = 0; e < this.length; e++) this[e].parentNode && this[e].parentNode.removeChild(this[e]);
					return this
				},
				add: function() {
					var e, a, r = this;
					for(e = 0; e < arguments.length; e++) {
						var s = t(arguments[e]);
						for(a = 0; a < s.length; a++) r[r.length] = s[a], r.length++
					}
					return r
				}
			}, t.fn = e.prototype, t.unique = function(e) {
				for(var t = [], a = 0; a < e.length; a++) - 1 === t.indexOf(e[a]) && t.push(e[a]);
				return t
			}, t
		}()), a = ["jQuery", "Zepto", "Dom7"], r = 0; r < a.length; r++) window[a[r]] && e(window[a[r]]);
	var s;
	s = "undefined" == typeof t ? window.Dom7 || window.Zepto || window.jQuery : t, s && ("transitionEnd" in s.fn || (s.fn.transitionEnd = function(e) {
		function t(i) {
			if(i.target === this)
				for(e.call(this, i), a = 0; a < r.length; a++) s.off(r[a], t)
		}
		var a, r = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"],
			s = this;
		if(e)
			for(a = 0; a < r.length; a++) s.on(r[a], t);
		return this
	}), "transform" in s.fn || (s.fn.transform = function(e) {
		for(var t = 0; t < this.length; t++) {
			var a = this[t].style;
			a.webkitTransform = a.MsTransform = a.msTransform = a.MozTransform = a.OTransform = a.transform = e
		}
		return this
	}), "transition" in s.fn || (s.fn.transition = function(e) {
		"string" != typeof e && (e += "ms");
		for(var t = 0; t < this.length; t++) {
			var a = this[t].style;
			a.webkitTransitionDuration = a.MsTransitionDuration = a.msTransitionDuration = a.MozTransitionDuration = a.OTransitionDuration = a.transitionDuration = e
		}
		return this
	}))
}(), "undefined" != typeof module ? module.exports = Swiper : "function" == typeof define && define.amd && define([], function() {
	"use strict";
	return Swiper
});
//# sourceMappingURL=maps/swiper.min.js.map