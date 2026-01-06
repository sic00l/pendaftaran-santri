/* ============================================
   AJAX Check Module
   Real-time checking untuk NIK dan Email
   ============================================ */

const AjaxChecker = {
    // Debounce function untuk mengurangi API calls
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    },

    // Check NIK availability
    async checkNIK(nik) {
        try {
            const response = await fetch(`/api/check-nik?nik=${encodeURIComponent(nik)}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error checking NIK:', error);
            return { error: true, message: 'Gagal memeriksa NIK' };
        }
    },

    // Check Email availability
    async checkEmail(email) {
        try {
            const response = await fetch(`/api/check-email?email=${encodeURIComponent(email)}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error checking email:', error);
            return { error: true, message: 'Gagal memeriksa email' };
        }
    },

    // Setup NIK checker
    setupNIKChecker(inputSelector) {
        const input = document.querySelector(inputSelector);
        if (!input) return;

        const errorContainer = this.createOrGetErrorContainer(input);

        const checkNIKDebounced = this.debounce(async (value) => {
            // Only check if NIK is 16 digits
            if (!/^\d{16}$/.test(value)) {
                return;
            }

            // Show loading state
            input.classList.add('loading');
            this.clearMessage(errorContainer);

            const result = await this.checkNIK(value);

            // Remove loading state
            input.classList.remove('loading');

            if (result.error) {
                this.showError(input, errorContainer, result.message);
            } else if (result.exists) {
                this.showError(input, errorContainer, '❌ NIK sudah terdaftar!');
            } else {
                this.showSuccess(input, errorContainer, '✅ NIK tersedia');
            }
        }, 500);

        input.addEventListener('input', (e) => {
            const value = e.target.value;
            if (value.length > 0) {
                checkNIKDebounced(value);
            } else {
                this.clearMessage(errorContainer);
                input.classList.remove('success', 'error', 'loading');
            }
        });
    },

    // Setup Email checker
    setupEmailChecker(inputSelector) {
        const input = document.querySelector(inputSelector);
        if (!input) return;

        const errorContainer = this.createOrGetErrorContainer(input);

        const checkEmailDebounced = this.debounce(async (value) => {
            // Basic email validation
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                return;
            }

            // Show loading state
            input.classList.add('loading');
            this.clearMessage(errorContainer);

            const result = await this.checkEmail(value);

            // Remove loading state
            input.classList.remove('loading');

            if (result.error) {
                this.showError(input, errorContainer, result.message);
            } else if (result.exists) {
                this.showError(input, errorContainer, '❌ Email sudah terdaftar!');
            } else {
                this.showSuccess(input, errorContainer, '✅ Email tersedia');
            }
        }, 500);

        input.addEventListener('input', (e) => {
            const value = e.target.value;
            if (value.length > 0) {
                checkEmailDebounced(value);
            } else {
                this.clearMessage(errorContainer);
                input.classList.remove('success', 'error', 'loading');
            }
        });
    },

    // Create or get error container
    createOrGetErrorContainer(input) {
        let container = input.parentElement.querySelector('.ajax-check-message');

        if (!container) {
            container = document.createElement('div');
            container.className = 'ajax-check-message';
            input.parentElement.appendChild(container);
        }

        return container;
    },

    // Show error message
    showError(input, container, message) {
        input.classList.remove('success', 'loading');
        input.classList.add('error');

        container.textContent = message;
        container.className = 'ajax-check-message error';
        container.style.display = 'block';
    },

    // Show success message
    showSuccess(input, container, message) {
        input.classList.remove('error', 'loading');
        input.classList.add('success');

        container.textContent = message;
        container.className = 'ajax-check-message success';
        container.style.display = 'block';
    },

    // Clear message
    clearMessage(container) {
        container.textContent = '';
        container.style.display = 'none';
    },

    // Initialize all checkers
    init() {
        this.setupNIKChecker('#nik');
        this.setupEmailChecker('#email');
    }
};

// Auto-initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    AjaxChecker.init();
});

// Export for use in other modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = AjaxChecker;
}
