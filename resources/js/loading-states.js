/* ============================================
   Loading States Module
   Handle loading animations dan skeleton screens
   ============================================ */

const LoadingStates = {
    // Show button loading
    showButtonLoading(button, originalText = null) {
        if (!button) return;

        // Store original text
        if (!button.dataset.originalText && originalText) {
            button.dataset.originalText = originalText;
        } else if (!button.dataset.originalText) {
            button.dataset.originalText = button.innerHTML;
        }

        button.disabled = true;
        button.classList.add('loading');
        button.innerHTML = `
            <svg class="animate-spin h-4 w-4 mr-2 inline" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
            </svg>
            Memproses...
        `;
    },

    // Hide button loading
    hideButtonLoading(button) {
        if (!button) return;

        button.disabled = false;
        button.classList.remove('loading');

        if (button.dataset.originalText) {
            button.innerHTML = button.dataset.originalText;
        }
    },

    // Show page loader (full screen)
    showPageLoader(message = 'Memuat...') {
        let loader = document.getElementById('page-loader');

        if (!loader) {
            loader = document.createElement('div');
            loader.id = 'page-loader';
            loader.className = 'fixed inset-0 bg-white bg-opacity-90 flex items-center justify-center z-50';
            loader.innerHTML = `
                <div class="text-center">
                    <div class="spinner spinner-lg mb-4"></div>
                    <p class="text-lg text-secondary">${message}</p>
                </div>
            `;
            document.body.appendChild(loader);
        }

        loader.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    },

    // Hide page loader
    hidePageLoader() {
        const loader = document.getElementById('page-loader');
        if (loader) {
            loader.style.display = 'none';
            document.body.style.overflow = '';
        }
    },

    // Show skeleton table
    showSkeletonTable(tableBody, rows = 5, columns = 6) {
        if (!tableBody) return;

        let html = '';
        for (let i = 0; i < rows; i++) {
            html += '<tr class="skeleton-row">';
            for (let j = 0; j < columns; j++) {
                html += '<td><div class="skeleton skeleton-text"></div></td>';
            }
            html += '</tr>';
        }

        tableBody.innerHTML = html;
    },

    // Show skeleton cards
    showSkeletonCards(container, count = 3) {
        if (!container) return;

        let html = '';
        for (let i = 0; i < count; i++) {
            html += `
                <div class="card">
                    <div class="card-body">
                        <div class="skeleton skeleton-title mb-4"></div>
                        <div class="skeleton skeleton-text mb-2"></div>
                        <div class="skeleton skeleton-text mb-2"></div>
                        <div class="skeleton skeleton-text" style="width: 60%;"></div>
                    </div>
                </div>
            `;
        }

        container.innerHTML = html;
    },

    // Show loading overlay on element
    showElementLoader(element, message = '') {
        if (!element) return;

        element.style.position = 'relative';

        let overlay = element.querySelector('.element-loader-overlay');
        if (!overlay) {
            overlay = document.createElement('div');
            overlay.className = 'element-loader-overlay';
            overlay.innerHTML = `
                <div class="absolute inset-0 bg-white bg-opacity-80 flex items-center justify-center z-10">
                    <div class="text-center">
                        <div class="spinner mb-2"></div>
                        ${message ? `<p class="text-sm text-secondary">${message}</p>` : ''}
                    </div>
                </div>
            `;
            element.appendChild(overlay);
        }

        overlay.style.display = 'block';
    },

    // Hide loading overlay on element
    hideElementLoader(element) {
        if (!element) return;

        const overlay = element.querySelector('.element-loader-overlay');
        if (overlay) {
            overlay.style.display = 'none';
        }
    },

    // Toast notification with auto-hide
    showToast(message, type = 'info', duration = 3000) {
        let container = document.getElementById('toast-container');

        if (!container) {
            container = document.createElement('div');
            container.id = 'toast-container';
            container.className = 'toast-container';
            document.body.appendChild(container);
        }

        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;

        const icons = {
            success: '✅',
            error: '❌',
            warning: '⚠️',
            info: 'ℹ️'
        };

        toast.innerHTML = `
            <div class="toast-icon">${icons[type] || icons.info}</div>
            <div class="toast-content">
                <p class="toast-message">${message}</p>
            </div>
            <button class="toast-close" onclick="this.parentElement.remove()">×</button>
        `;

        container.appendChild(toast);

        // Auto remove after duration
        setTimeout(() => {
            toast.classList.add('hiding');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, duration);
    },

    // Progress bar
    updateProgressBar(selector, percentage) {
        const progressBar = document.querySelector(selector);
        if (progressBar) {
            progressBar.style.width = `${percentage}%`;
            progressBar.setAttribute('aria-valuenow', percentage);
        }
    },

    // Show/Hide specific section loader
    showSectionLoader(sectionId) {
        const section = document.getElementById(sectionId);
        if (section) {
            this.showElementLoader(section, 'Memuat data...');
        }
    },

    hideSectionLoader(sectionId) {
        const section = document.getElementById(sectionId);
        if (section) {
            this.hideElementLoader(section);
        }
    },

    // Fetch with loading state
    async fetchWithLoading(url, options = {}, loadingOptions = {}) {
        const {
            button = null,
            showPageLoading = false,
            showToastOnError = true,
            successMessage = null
        } = loadingOptions;

        try {
            // Show loading
            if (button) {
                this.showButtonLoading(button);
            }
            if (showPageLoading) {
                this.showPageLoader();
            }

            // Fetch data
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    ...options.headers
                },
                ...options
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Terjadi kesalahan');
            }

            // Show success message if provided
            if (successMessage) {
                this.showToast(successMessage, 'success');
            }

            return data;

        } catch (error) {
            console.error('Fetch error:', error);

            if (showToastOnError) {
                this.showToast(error.message || 'Terjadi kesalahan', 'error');
            }

            throw error;

        } finally {
            // Hide loading
            if (button) {
                this.hideButtonLoading(button);
            }
            if (showPageLoading) {
                this.hidePageLoader();
            }
        }
    },

    // Countdown timer
    startCountdown(elementId, targetDate) {
        const element = document.getElementById(elementId);
        if (!element) return;

        const updateCountdown = () => {
            const now = new Date().getTime();
            const distance = new Date(targetDate).getTime() - now;

            if (distance < 0) {
                element.innerHTML = '<p class="text-error">Waktu telah berakhir</p>';
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            element.innerHTML = `
                <div class="countdown">
                    <div class="countdown-item">
                        <span class="countdown-value">${days}</span>
                        <span class="countdown-label">Hari</span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-value">${hours}</span>
                        <span class="countdown-label">Jam</span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-value">${minutes}</span>
                        <span class="countdown-label">Menit</span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-value">${seconds}</span>
                        <span class="countdown-label">Detik</span>
                    </div>
                </div>
            `;
        };

        updateCountdown();
        setInterval(updateCountdown, 1000);
    },

    // Animate counter (for stats)
    animateCounter(element, targetValue, duration = 2000) {
        if (!element) return;

        const start = 0;
        const startTime = Date.now();
        const endTime = startTime + duration;

        const tick = () => {
            const now = Date.now();
            const progress = Math.min((now - startTime) / duration, 1);
            const currentValue = Math.floor(progress * (targetValue - start) + start);

            element.textContent = currentValue;

            if (progress < 1) {
                requestAnimationFrame(tick);
            } else {
                element.textContent = targetValue;
            }
        };

        tick();
    }
};

// Auto-hide page loader on window load
window.addEventListener('load', () => {
    LoadingStates.hidePageLoader();
});

// Export for use in other modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = LoadingStates;
}
