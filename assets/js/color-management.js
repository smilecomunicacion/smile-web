/**
 * Color Management JavaScript for SMiLE Web Theme Customizer.
 *
 * Handles export, import, and reset functionality for theme colors.
 *
 * @package smile-web
 * @since 6.0.7
 */

(function() {
    'use strict';

    // Flag to prevent multiple initializations
    let isInitialized = false;

    /**
     * Initialize color management functionality when the document is ready.
     */
    document.addEventListener('DOMContentLoaded', function() {
        // Try to initialize immediately, and also with delays for WordPress Customizer
        tryInitialize();

        // Multiple retries with increasing delays to handle WordPress Customizer loading
        setTimeout(tryInitialize, 500);
        setTimeout(tryInitialize, 1000);
        setTimeout(tryInitialize, 2000);
        setTimeout(tryInitialize, 3000);
        setTimeout(tryInitialize, 5000);
    });

    // Also try to initialize when the customizer is ready (if available)
    if (typeof wp !== 'undefined' && wp.customize) {
        wp.customize.bind('ready', function() {
            setTimeout(tryInitialize, 100);
            setTimeout(tryInitialize, 500);
        });
    }

    // Use MutationObserver to detect when new elements are added to the DOM
    if (typeof MutationObserver !== 'undefined') {
        const observer = new MutationObserver(function(mutations) {
            // Only try to initialize if we haven't already succeeded
            if (!isInitialized) {
                let shouldTry = false;
                mutations.forEach(function(mutation) {
                    mutation.addedNodes.forEach(function(node) {
                        if (node.nodeType === Node.ELEMENT_NODE) {
                            // Check if any of our target elements were added
                            if (node.querySelector && (
                                node.querySelector('.smile-v6-export-colors') ||
                                node.querySelector('.smile-v6-import-colors') ||
                                node.querySelector('.smile-v6-reset-colors') ||
                                node.classList.contains('smile-v6-export-colors') ||
                                node.classList.contains('smile-v6-import-colors') ||
                                node.classList.contains('smile-v6-reset-colors')
                            )) {
                                shouldTry = true;
                            }
                        }
                    });
                });

                if (shouldTry) {
                    setTimeout(tryInitialize, 10);
                }
            }
        });

        // Start observing
        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    }

    /**
     * Try to initialize, but only if not already initialized.
     */
    function tryInitialize() {
        if (isInitialized) {
            return;
        }

        // Check if elements are available
        const exportButton = document.querySelector('.smile-v6-export-colors');
        const importButton = document.querySelector('.smile-v6-import-colors');
        const resetButton = document.querySelector('.smile-v6-reset-colors');

        if (!exportButton && !importButton && !resetButton) {
            return;
        }

        initializeColorManagement();
    }    /**
     * Initialize all color management event listeners.
     */
    function initializeColorManagement() {
        console.log('Attempting to initialize color management...');

        // Check if smile_v6_ajax is available
        if (typeof smile_v6_ajax === 'undefined') {
            return;
        }

        // Try to initialize each function - only mark as initialized if at least one succeeds
        let initializedCount = 0;

        if (initializeExportColors()) initializedCount++;
        if (initializeImportColors()) initializedCount++;
        if (initializeResetColors()) initializedCount++;

        if (initializedCount > 0) {
            // Mark as initialized to prevent duplicate initialization
            isInitialized = true;
        }
    }    /**
     * Initialize export colors functionality.
     * @return {boolean} True if initialization was successful, false otherwise.
     */
    function initializeExportColors() {
        const exportButton = document.querySelector('.smile-v6-export-colors');
        if (!exportButton) {
            return false;
        }

        exportButton.addEventListener('click', function(e) {
            e.preventDefault();

            // Final check for smile_v6_ajax availability
            if (typeof smile_v6_ajax === 'undefined' || !smile_v6_ajax.nonce) {
                console.error('smile_v6_ajax or nonce not available during export');
                alert('Error: Security token not available. Please refresh the page and try again.');
                return;
            }

            // Disable button during export.
            exportButton.disabled = true;
            exportButton.textContent = 'Exporting...';

            // Create form data.
            const formData = new FormData();
            formData.append('action', 'smile_v6_export_colors');
            formData.append('nonce', smile_v6_ajax.nonce);

            // Send AJAX request.
            fetch(smile_v6_ajax.ajaxurl, {
                method: 'POST',
                body: formData
            })
            .then(response => response.blob())
            .then(blob => {
                // Create download link.
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.style.display = 'none';
                a.href = url;
                a.download = 'smile-web-colors-' + getCurrentDateTime() + '.json';
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
                document.body.removeChild(a);

                showMessage('Color settings exported successfully!', 'success');
            })
            .catch(error => {
                showMessage('Export failed. Please try again.', 'error');
            })
            .finally(() => {
                // Re-enable button.
                exportButton.disabled = false;
                exportButton.textContent = 'Download Colors JSON';
            });
        });

        return true;
    }

    /**
     * Initialize import colors functionality.
     * @return {boolean} True if initialization was successful, false otherwise.
     */
    function initializeImportColors() {
        const fileInput = document.querySelector('.smile-v6-import-file');
        const importButton = document.querySelector('.smile-v6-import-colors');
        const statusDiv = document.querySelector('.smile-v6-import-status');

        if (!fileInput || !importButton || !statusDiv) {
            return false;
        }

        // Enable import button when file is selected.
        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file && file.type === 'application/json') {
                importButton.disabled = false;
                statusDiv.innerHTML = '<span class="smile-v6-status-message smile-v6-status-message--info">File selected: ' + escapeHtml(file.name) + '</span>';
            } else {
                importButton.disabled = true;
                statusDiv.innerHTML = '<span class="smile-v6-status-message smile-v6-status-message--error">Please select a valid JSON file.</span>';
            }
        });

        // Handle import button click.
        importButton.addEventListener('click', function(e) {
            e.preventDefault();

            const file = fileInput.files[0];
            if (!file) {
                showMessage('Please select a file to import.', 'error');
                return;
            }

            // Verify nonce is available
            if (!smile_v6_ajax.nonce) {
                showMessage('Import failed: Security token missing.', 'error');
                return;
            }

            // Disable button during import.
            importButton.disabled = true;
            importButton.textContent = 'Importing...';
            statusDiv.innerHTML = '<span class="smile-v6-status-message smile-v6-status-message--info">Importing colors...</span>';

            // Create form data.
            const formData = new FormData();
            formData.append('action', 'smile_v6_import_colors');
            formData.append('nonce', smile_v6_ajax.nonce);
            formData.append('colors_file', file);

            // Send AJAX request.
            fetch(smile_v6_ajax.ajaxurl, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    statusDiv.innerHTML = '<span class="smile-v6-status-message smile-v6-status-message--success">' + escapeHtml(data.data.message) + '</span>';
                    showMessage(data.data.message, 'success');

                    // Refresh the customizer preview.
                    if (wp && wp.customize && wp.customize.previewer) {
                        wp.customize.previewer.refresh();
                    }
                } else {
                    statusDiv.innerHTML = '<span class="smile-v6-status-message smile-v6-status-message--error">' + escapeHtml(data.data.message) + '</span>';
                    showMessage(data.data.message, 'error');
                }
            })
            .catch(error => {
                const errorMessage = 'Import failed. Please check the file format and try again.';
                statusDiv.innerHTML = '<span class="smile-v6-status-message smile-v6-status-message--error">' + errorMessage + '</span>';
                showMessage(errorMessage, 'error');
            })
            .finally(() => {
                // Re-enable button.
                importButton.disabled = fileInput.files.length === 0;
                importButton.textContent = 'Import Colors';
            });
        });

        return true;
    }

    /**
     * Initialize reset colors functionality.
     * @return {boolean} True if initialization was successful, false otherwise.
     */
    function initializeResetColors() {
        const resetButton = document.querySelector('.smile-v6-reset-colors');
        const statusDiv = document.querySelector('.smile-v6-reset-status');

        if (!resetButton || !statusDiv) {
            return false;
        }

        resetButton.addEventListener('click', function(e) {
            e.preventDefault();

            // Confirm reset action.
            if (!confirm('Are you sure you want to reset all colors to the Ocean Professional defaults? This action cannot be undone.')) {
                return;
            }

            // Use nonce from wp_localize_script.
            if (!smile_v6_ajax || !smile_v6_ajax.nonce) {
                showMessage('Reset failed: Security token missing.', 'error');
                return;
            }

            // Disable button during reset.
            resetButton.disabled = true;
            resetButton.textContent = 'Resetting...';
            statusDiv.innerHTML = '<span class="smile-v6-status-message smile-v6-status-message--info">Resetting colors...</span>';

            // Create form data.
            const formData = new FormData();
            formData.append('action', 'smile_v6_reset_colors');
            formData.append('nonce', smile_v6_ajax.nonce);

            // Send AJAX request.
            fetch(smile_v6_ajax.ajaxurl, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    statusDiv.innerHTML = '<span class="smile-v6-status-message smile-v6-status-message--success">' + escapeHtml(data.data.message) + '</span>';
                    showMessage(data.data.message, 'success');

                    // Refresh the customizer preview.
                    if (wp && wp.customize && wp.customize.previewer) {
                        wp.customize.previewer.refresh();
                    }
                } else {
                    statusDiv.innerHTML = '<span class="smile-v6-status-message smile-v6-status-message--error">' + escapeHtml(data.data.message) + '</span>';
                    showMessage(data.data.message, 'error');
                }
            })
            .catch(error => {
                const errorMessage = 'Reset failed. Please try again.';
                statusDiv.innerHTML = '<span class="smile-v6-status-message smile-v6-status-message--error">' + errorMessage + '</span>';
                showMessage(errorMessage, 'error');
            })
            .finally(() => {
                // Re-enable button.
                resetButton.disabled = false;
                resetButton.textContent = 'Reset All Colors';
            });
        });

        return true;
    }

    /**
     * Show a message using WordPress admin notices.
     *
     * @param {string} message - The message to display.
     * @param {string} type - The message type (success, error, warning, info).
     */
    function showMessage(message, type) {
        // Create notice element.
        const notice = document.createElement('div');
        notice.className = 'notice notice-' + type + ' is-dismissible smile-v6-notice';
        notice.innerHTML = '<p>' + escapeHtml(message) + '</p>';

        // Add dismiss button functionality.
        const dismissButton = document.createElement('button');
        dismissButton.type = 'button';
        dismissButton.className = 'notice-dismiss';
        dismissButton.innerHTML = '<span class="screen-reader-text">Dismiss this notice.</span>';
        dismissButton.addEventListener('click', function() {
            notice.remove();
        });
        notice.appendChild(dismissButton);

        // Insert at the top of the customizer.
        const customizer = document.querySelector('#customize-controls');
        if (customizer) {
            customizer.insertBefore(notice, customizer.firstChild);
        }

        // Auto-remove after 5 seconds.
        setTimeout(function() {
            if (notice.parentNode) {
                notice.remove();
            }
        }, 5000);
    }

    /**
     * Get current date and time in YYYY-MM-DD-HH-MM-SS format.
     *
     * @return {string} Formatted date string.
     */
    function getCurrentDateTime() {
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        return year + '-' + month + '-' + day + '-' + hours + '-' + minutes + '-' + seconds;
    }

    /**
     * Escape HTML to prevent XSS attacks.
     *
     * @param {string} text - The text to escape.
     * @return {string} Escaped text.
     */
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

})();