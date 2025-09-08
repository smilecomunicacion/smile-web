/**
 * Theme Name: SMiLE Web
 * Theme URI: https://smilecomunicacion.com/web/wordpress/smile-web/
 * Version: 6.0.0
 * Author: SMiLE Comunicación
 * Author URI: https://www.linkedin.com/in/cesarbla/
 * License: GNU General Public License v2 or later
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Description: Free theme, SEO optimized. Gain visibility and reach the top positions in search engines quickly. Fully configured and very easy to self-manage with the integration of WordPress Guttemberg blocks editor.
 */

/* Sticky Header */
window.addEventListener('scroll', () => {
	const header = document.getElementById('masthead')
	if (window.scrollY > 0) {
		header.classList.add('header-scrolled')
	} else {
		header.classList.remove('header-scrolled')
	}
})

/* Add arrow when exists child menu item */
document.addEventListener('DOMContentLoaded', function () {
	// Seleccionar todos los elementos con submenús
	const menuItems = document.querySelectorAll('.menu-item-has-children')

	menuItems.forEach((item) => {
		// Crear y agregar flechita si no existe
		let icon = item.querySelector('i')
		if (!icon) {
			// Crear y agregar flechita si no existe.
			icon = document.createElement('i')
			icon.className = 'child-arrow-down'
			icon.setAttribute('tabindex', '0') // Hacer que la flechita sea navegable con TAB.
			icon.setAttribute('role', 'button') // Asegurar accesibilidad como botón.
			icon.setAttribute('aria-expanded', 'false')
			const link = item.querySelector('a')
			if (link) {
				item.insertBefore(icon, link)
			}
		}
		// Toggle sub-menu y rotar flechita al hacer clic.
		icon.addEventListener('click', function () {
			const subMenu = item.querySelector('.sub-menu')
			toggleSubMenu(subMenu)
			this.classList.toggle('child-arrow-down')
			this.classList.toggle('child-arrow-up')
			const expanded = this.classList.contains('child-arrow-up')
			this.setAttribute('aria-expanded', expanded.toString())
		})
		// Abrir submenú al presionar Enter sobre la flechita.
		icon.addEventListener('keydown', function (event) {
			if (event.key === 'Enter') {
				event.preventDefault()
				const subMenu = item.querySelector('.sub-menu')
				toggleSubMenu(subMenu)
				this.classList.toggle('child-arrow-down')
				this.classList.toggle('child-arrow-up')
				const expanded = this.classList.contains('child-arrow-up')
				this.setAttribute('aria-expanded', expanded.toString())
			}
		})
	})

	function toggleSubMenu(subMenu) {
		if (subMenu.style.maxHeight && subMenu.style.maxHeight !== '0px') {
			subMenu.style.maxHeight = '0px'
		} else {
			subMenu.style.maxHeight = subMenu.scrollHeight + 'px'
			updateParentMenus(subMenu)
		}
	}

	function updateParentMenus(subMenu) {
		let parent = subMenu.parentNode.closest('.sub-menu')
		while (parent) {
			parent.style.maxHeight = 'none'
			let activeChildrenHeight = 0
			Array.from(parent.children).forEach((child) => {
				if (child.style.maxHeight !== '0px') {
					activeChildrenHeight += child.scrollHeight
				}
			})
			parent.style.maxHeight = parent.scrollHeight + activeChildrenHeight + 'px'
			parent = parent.parentNode.closest('.sub-menu')
		}
	}
})

// Control del menú móvil
const toggle = document.getElementById('nav-toggle')
const menu = document.getElementById('nav-menu')

toggle.addEventListener('click', () => {
	menu.classList.toggle('nav-menu-active')
	toggle.classList.toggle('menu-bar-change')
	if (menu.classList.contains('nav-menu-active')) {
		toggle.setAttribute('aria-label', 'Close Menú')
	} else {
		toggle.setAttribute('aria-label', 'Open Menú')
	}
})

// Cerrar el menú al hacer clic en un enlace
document.querySelectorAll('#nav-menu a').forEach((link) => {
	link.addEventListener('click', () => {
		if (menu.classList.contains('nav-menu-active')) {
			menu.classList.remove('nav-menu-active')
			toggle.classList.remove('menu-bar-change')
			toggle.setAttribute('aria-label', 'Abrir Menú')
		}
	})
})

// Close menu when clicking outside
document.addEventListener('click', function (event) {
	if (
		!menu.contains(event.target) &&
		!toggle.contains(event.target) &&
		menu.classList.contains('nav-menu-active')
	) {
		menu.classList.remove('nav-menu-active')
		toggle.classList.remove('menu-bar-change')
		toggle.setAttribute('aria-label', 'Abrir Menú')
	}
})

/*****************************
 ***** MODAL SEARCH
 ******************************/
document.addEventListener('DOMContentLoaded', function () {
	// Obtener elementos del modal
	const modal = document.getElementById('modalBuscador')
	const btns = document.querySelectorAll('.buscar')
	const closeBtn = document.querySelector('.modal-header .close')
	const inputField = document.getElementById('myInput')
	const focusableElementsSelector = 'input, button, [tabindex]:not([tabindex="-1"])' // Elementos que pueden recibir foco
	let lastFocusedElement // Para almacenar el elemento enfocado antes de abrir el modal
	let handleFocusTrap // Referencia al manejador de eventos para trapFocus

	// Abrir modal
	function openModal() {
		lastFocusedElement = modal.ownerDocument.activeElement // Guardar el último elemento enfocado usando ownerDocument
		modal.style.display = 'block'
		inputField.focus() // Enfocar el campo de entrada al abrir
		trapFocus(modal) // Activar la trampa de enfoque
	}

	// Cerrar modal
	function closeModal() {
		modal.style.display = 'none'
		if (lastFocusedElement) {
			lastFocusedElement.focus() // Devolver el foco al elemento anterior
		}
		removeTrapFocus() // Desactivar la trampa de enfoque
	}

	// Trampa de enfoque dentro del modal
	function trapFocus(element) {
		const focusableContent = element.querySelectorAll(focusableElementsSelector)
		if (focusableContent.length === 0) {
			return
		} // Si no hay elementos enfocables, no hacemos nada

		const firstFocusableElement = focusableContent[0]
		const lastFocusableElement = focusableContent[focusableContent.length - 1]

		handleFocusTrap = function (event) {
			const activeElement = element.ownerDocument.activeElement

			if (event.key === 'Tab') {
				if (event.shiftKey && activeElement === firstFocusableElement) {
					event.preventDefault()
					lastFocusableElement.focus()
				} else if (!event.shiftKey && activeElement === lastFocusableElement) {
					event.preventDefault()
					firstFocusableElement.focus()
				}
			} else if (event.key === 'Escape') {
				// Cerrar modal con ESC
				event.preventDefault()
				closeModal()
			}
		}

		element.addEventListener('keydown', handleFocusTrap)
	}

	// Eliminar trampa de enfoque
	function removeTrapFocus() {
		if (handleFocusTrap) {
			modal.removeEventListener('keydown', handleFocusTrap)
			handleFocusTrap = null
		}
	}

	// Asignar eventos de apertura y cierre
	btns.forEach((btn) => btn.addEventListener('click', openModal))
	if (closeBtn) {
		closeBtn.addEventListener('click', closeModal)
	}

	// Cerrar modal al hacer clic fuera del contenido
	window.addEventListener('click', (event) => {
		if (event.target === modal) {
			closeModal()
		}
	})

	// Manejar la tecla Enter en el botón de cierre
	if (closeBtn) {
		closeBtn.addEventListener('keydown', (event) => {
			if (event.key === 'Enter') {
				event.preventDefault()
				closeModal()
			}
		})
	}
})
