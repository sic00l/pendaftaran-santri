/* ============================================
   Image Preview Module
   Preview untuk file upload (foto, dokumen)
   ============================================ */

const ImagePreview = {
    // Setup image preview untuk single file
    setupImagePreview(inputSelector, previewSelector, options = {}) {
        const input = document.querySelector(inputSelector);
        const preview = document.querySelector(previewSelector);

        if (!input || !preview) {
            console.warn('Input or preview element not found');
            return;
        }

        const defaults = {
            maxSize: 2 * 1024 * 1024, // 2MB default
            allowedTypes: ['image/jpeg', 'image/png', 'image/jpg'],
            errorCallback: null,
            successCallback: null
        };

        const config = { ...defaults, ...options };

        input.addEventListener('change', (e) => {
            const file = e.target.files[0];

            if (!file) {
                this.clearPreview(preview);
                return;
            }

            // Validate file size
            if (file.size > config.maxSize) {
                const sizeMB = (config.maxSize / 1024 / 1024).toFixed(0);
                this.showError(input, `Ukuran file maksimal ${sizeMB}MB`);
                if (config.errorCallback) config.errorCallback(`File terlalu besar`);
                input.value = '';
                return;
            }

            // Validate file type
            if (!config.allowedTypes.includes(file.type)) {
                this.showError(input, 'Hanya file JPG/PNG yang diperbolehkan');
                if (config.errorCallback) config.errorCallback('Tipe file tidak valid');
                input.value = '';
                return;
            }

            // Show preview
            const reader = new FileReader();

            reader.onload = (e) => {
                if (file.type.startsWith('image/')) {
                    this.showImagePreview(preview, e.target.result, file);
                } else {
                    this.showFileInfo(preview, file);
                }

                if (config.successCallback) config.successCallback(file);
            };

            reader.onerror = () => {
                this.showError(input, 'Gagal membaca file');
                if (config.errorCallback) config.errorCallback('File error');
            };

            reader.readAsDataURL(file);
        });
    },

    // Show image preview
    showImagePreview(previewEl, dataUrl, file) {
        previewEl.innerHTML = `
            <div class="file-preview">
                <div class="file-preview-image">
                    <img src="${dataUrl}" alt="Preview">
                </div>
                <div class="file-preview-info">
                    <div class="file-preview-name">${file.name}</div>
                    <div class="file-preview-size">${this.formatFileSize(file.size)}</div>
                    <button type="button" class="file-preview-remove" onclick="ImagePreview.removePreview(this)">
                        ✕ Hapus
                    </button>
                </div>
            </div>
        `;
        previewEl.style.display = 'block';
    },

    // Show file info (for non-image files)
    showFileInfo(previewEl, file) {
        const icon = this.getFileIcon(file.type);

        previewEl.innerHTML = `
            <div class="file-preview">
                <div class="file-preview-icon">${icon}</div>
                <div class="file-preview-info">
                    <div class="file-preview-name">${file.name}</div>
                    <div class="file-preview-size">${this.formatFileSize(file.size)}</div>
                    <div class="file-preview-type">${file.type || 'Unknown'}</div>
                    <button type="button" class="file-preview-remove" onclick="ImagePreview.removePreview(this)">
                        ✕ Hapus
                    </button>
                </div>
            </div>
        `;
        previewEl.style.display = 'block';
    },

    // Clear preview
    clearPreview(previewEl) {
        previewEl.innerHTML = '';
        previewEl.style.display = 'none';
    },

    // Remove preview and clear input
    removePreview(button) {
        const preview = button.closest('.file-preview-container') ||
            button.closest('[id$="-preview"]');

        if (preview) {
            const inputId = preview.id.replace('-preview', '');
            const input = document.getElementById(inputId);

            if (input) {
                input.value = '';
            }

            this.clearPreview(preview);
        }
    },

    // Format file size
    formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';

        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));

        return Math.round((bytes / Math.pow(k, i)) * 100) / 100 + ' ' + sizes[i];
    },

    // Get file icon based on type
    getFileIcon(type) {
        if (type.startsWith('image/')) return '🖼️';
        if (type.includes('pdf')) return '📄';
        if (type.includes('word') || type.includes('document')) return '📝';
        if (type.includes('excel') || type.includes('spreadsheet')) return '📊';
        return '📎';
    },

    // Show error message
    showError(input, message) {
        let errorEl = input.parentElement.querySelector('.form-error');

        if (!errorEl) {
            errorEl = document.createElement('span');
            errorEl.className = 'form-error';
            input.parentElement.appendChild(errorEl);
        }

        errorEl.textContent = message;
        input.classList.add('error');

        setTimeout(() => {
            errorEl.remove();
            input.classList.remove('error');
        }, 3000);
    },

    // Setup multiple file preview (for multiple uploads)
    setupMultipleImagePreview(inputSelector, containerSelector, options = {}) {
        const input = document.querySelector(inputSelector);
        const container = document.querySelector(containerSelector);

        if (!input || !container) {
            console.warn('Input or container element not found');
            return;
        }

        input.setAttribute('multiple', 'multiple');

        const defaults = {
            maxSize: 2 * 1024 * 1024,
            maxFiles: 5,
            allowedTypes: ['image/jpeg', 'image/png', 'image/jpg']
        };

        const config = { ...defaults, ...options };

        input.addEventListener('change', (e) => {
            const files = Array.from(e.target.files);

            if (files.length > config.maxFiles) {
                this.showError(input, `Maksimal ${config.maxFiles} file`);
                input.value = '';
                return;
            }

            container.innerHTML = '';

            files.forEach((file, index) => {
                if (file.size > config.maxSize) {
                    this.showError(input, `File ${file.name} terlalu besar`);
                    return;
                }

                if (!config.allowedTypes.includes(file.type)) {
                    this.showError(input, `File ${file.name} tipe tidak valid`);
                    return;
                }

                const reader = new FileReader();
                reader.onload = (e) => {
                    const previewHtml = `
                        <div class="file-preview-item" data-index="${index}">
                            <img src="${e.target.result}" alt="${file.name}">
                            <button type="button" class="remove-item" onclick="ImagePreview.removeMultipleItem(this)">✕</button>
                            <div class="file-name">${file.name}</div>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', previewHtml);
                };
                reader.readAsDataURL(file);
            });
        });
    },

    // Remove item from multiple preview
    removeMultipleItem(button) {
        const item = button.closest('.file-preview-item');
        if (item) {
            item.remove();
        }
    },

    // Initialize all previews
    init() {
        // Setup foto 3x4 preview
        this.setupImagePreview('#foto', '#foto-preview', {
            maxSize: 2 * 1024 * 1024, // 2MB
            allowedTypes: ['image/jpeg', 'image/png', 'image/jpg']
        });

        // Setup dokumen previews (if they exist)
        this.setupImagePreview('#ijazah', '#ijazah-preview', {
            maxSize: 5 * 1024 * 1024, // 5MB
            allowedTypes: ['application/pdf', 'image/jpeg', 'image/png']
        });

        this.setupImagePreview('#akta', '#akta-preview', {
            maxSize: 5 * 1024 * 1024, // 5MB
            allowedTypes: ['application/pdf', 'image/jpeg', 'image/png']
        });
    }
};

// Auto-initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    ImagePreview.init();
});

// Export for use in other modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = ImagePreview;
}
