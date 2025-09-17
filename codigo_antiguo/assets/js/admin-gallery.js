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

document.addEventListener('DOMContentLoaded', function () {
	const uploadButton = document.querySelector('.upload_image_button')
	const imageList = document.querySelector('.image-preview-list')
	const imageInput = document.getElementById('smile-client-logos')

	uploadButton.addEventListener('click', function (e) {
		e.preventDefault()
		let imageFrame = null

		if (imageFrame) {
			imageFrame.open()
		}

		// Define imageFrame as wp.media object
		imageFrame = wp.media({
			title: 'Seleccionar Imagen',
			multiple: true,
			library: {
				type: 'image',
			},
		})

		imageFrame.on('select', function () {
			const selection = imageFrame.state().get('selection')
			const galleryIds = []
			selection.forEach((attachment) => {
				galleryIds.push(attachment.id)
				const thumbnail = attachment.sizes.thumbnail.url
				const li = document.createElement('li')
				const img = document.createElement('img')
				img.src = thumbnail
				img.style.maxWidth = '100px'
				img.style.maxHeight = '100px'
				const removeButton = document.createElement('a')
				removeButton.href = '#'
				removeButton.textContent = 'Remover'
				removeButton.style.display = 'block'
				removeButton.className = 'remove_image_button'
				removeButton.onclick = function (event) {
					event.preventDefault()
					li.remove()
					updateImageInput()
				}
				li.appendChild(img)
				li.appendChild(removeButton)
				imageList.appendChild(li)
			})
			updateImageInput()
		})

		imageFrame.open()
	})

	function updateImageInput() {
		const images = imageList.querySelectorAll('img')
		const ids = Array.from(images).map((img) => img.getAttribute('data-id'))
		imageInput.value = ids.join(',')
	}
})
