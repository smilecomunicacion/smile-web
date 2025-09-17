/**
 * Theme Name: SMiLE Web
 * Theme URI: https://smilecomunicacion.com/web/wordpress/smile-web/
 * Version: 6.0.0
 * Author: SMiLE Comunicación
 * Author URI: https://www.linkedin.com/in/cesarbla/
 * License: GNU General Public License v2 or later
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Description: Free theme, SEO optimized. Gain visibility and reach the top positions in search engines quickly. Fully configured and very easy to self-manage with the integration of WordPress Gutenberg blocks editor.
 *
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

;(function () {
	const siteNavigation = document.getElementById('site-navigation')

	// Return early if the navigation doesn't exist.
	if (!siteNavigation) {
		return
	}

	const button = siteNavigation.querySelector('button')

	// Return early if the button doesn't exist.
	if (typeof button === 'undefined') {
		return
	}

	const menu = siteNavigation.querySelector('ul')

	// Hide menu toggle button if menu is empty and return early.
	if (typeof menu === 'undefined') {
		button.style.display = 'none'
		return
	}

	if (!menu.classList.contains('nav-menu')) {
		menu.classList.add('nav-menu')
	}

	// Toggle the .toggled class and the aria-expanded value each time the button is clicked.
	button.addEventListener('click', function () {
		siteNavigation.classList.toggle('toggled')

		const expanded = button.getAttribute('aria-expanded') === 'true'
		button.setAttribute('aria-expanded', !expanded)
	})

	// Remove the .toggled class and set aria-expanded to false when the user clicks outside the navigation.
	document.addEventListener('click', function (event) {
		const isClickInside = siteNavigation.contains(event.target)

		if (!isClickInside) {
			siteNavigation.classList.remove('toggled')
			button.setAttribute('aria-expanded', 'false')
		}
	})

	// Get all the link elements within the menu.
	const links = menu.querySelectorAll('a')

	// Get all the link elements with children within the menu.
	const linksWithChildren = menu.querySelectorAll(
		'.menu-item-has-children > a, .page_item_has_children > a'
	)

	// Toggle focus each time a menu link is focused or blurred.
	for (const link of links) {
		link.addEventListener('focus', toggleFocus, true)
		link.addEventListener('blur', toggleFocus, true)
	}

	// Toggle focus each time a menu link with children receives a touch event.
	for (const link of linksWithChildren) {
		link.addEventListener('focus', function () {
			const parentMenu = link.parentNode.querySelector('.sub-menu')
			if (parentMenu) {
				parentMenu.style.display = 'block'
			}
		})
		link.addEventListener('blur', function () {
			const parentMenu = link.parentNode.querySelector('.sub-menu')
			if (parentMenu) {
				parentMenu.style.display = 'none'
			}
		})
	}

	/**
	 * Sets or removes .focus class on an element.
	 * @param {Event} event
	 */
	function toggleFocus(event) {
		if (event.type === 'focus' || event.type === 'blur') {
			let self = this
			// Move up through the ancestors of the current link until we hit .nav-menu.
			while (!self.classList.contains('nav-menu')) {
				// On li elements toggle the class .focus.
				if (self.tagName.toLowerCase() === 'li') {
					self.classList.toggle('focus')
				}
				self = self.parentNode
			}
		}

		if (event.type === 'touchstart') {
			const menuItem = this.parentNode
			event.preventDefault()
			for (const link of menuItem.parentNode.children) {
				if (menuItem !== link) {
					link.classList.remove('focus')
				}
			}
			menuItem.classList.toggle('focus')
		}
	}
})()
