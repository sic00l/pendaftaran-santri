/* ============================================
   Main Application JavaScript
   Entry point untuk semua JavaScript modules
   ============================================ */

// Import all modules (jika menggunakan bundler seperti Vite)
// import './bootstrap';

// Initialize common functionality
document.addEventListener('DOMContentLoaded', () => {
    console.log('Santri Registration System - JavaScript Loaded');

    // Initialize common UI components
    initializeCommonComponents();

    // Setup CSRF token untuk AJAX requests
    setupCSRFToken();

    // Setup navbar mobile menu
    setupMobileMenu();

    // Setup sidebar toggle (admin)
    setupSidebarToggle();

    // Setup modals
    setupModals();

    // Setup dropdowns
    setupDropdowns();

    // Setup tooltips
    setupTooltips();
});

// Initialize common components
function initializeCommonComponents() {
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });

    // Close alert buttons
    document.querySelectorAll('.alert-close').forEach(btn => {
        btn.addEventListener('click', function () {
            this.closest('.alert').remove();
        });
    });
}

// Setup CSRF Token for AJAX
function setupCSRFToken() {
    const token = document.querySelector('meta[name="csrf-token"]');

    if (token) {
        // Add CSRF token to all AJAX requests
        window.csrfToken = token.getAttribute('content');

        // Setup default headers for fetch
        const originalFetch = window.fetch;
        window.fetch = function (url, options = {}) {
            if (!options.headers) {
                options.headers = {};
            }

            if (!(options.headers instanceof Headers)) {
                options.headers = new Headers(options.headers);
            }

            if (!options.headers.has('X-CSRF-TOKEN') && window.csrfToken) {
                options.headers.set('X-CSRF-TOKEN', window.csrfToken);
            }

            return originalFetch(url, options);
        };
    }
}

// Setup mobile menu toggle
function setupMobileMenu() {
    const toggle = document.querySelector('.navbar-toggle');
    const menu = document.querySelector('.navbar-mobile-menu');

    if (toggle && menu) {
        toggle.addEventListener('click', () => {
            menu.classList.toggle('active');
        });

        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!toggle.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.remove('active');
            }
        });

        // Close menu when clicking a link
        menu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                menu.classList.remove('active');
            });
        });
    }
}

// Setup sidebar toggle (admin panel)
function setupSidebarToggle() {
    const toggle = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    const backdrop = document.querySelector('.sidebar-backdrop');

    if (toggle && sidebar) {
        toggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            if (backdrop) {
                backdrop.classList.toggle('active');
            }
        });

        // Close sidebar when clicking backdrop
        if (backdrop) {
            backdrop.addEventListener('click', () => {
                sidebar.classList.remove('active');
                backdrop.classList.remove('active');
            });
        }
    }
}

// Setup modal functionality
function setupModals() {
    // Close modal buttons
    document.querySelectorAll('.modal-close, [data-close-modal]').forEach(btn => {
        btn.addEventListener('click', function () {
            const modal = this.closest('.modal-backdrop');
            if (modal) {
                closeModal(modal);
            }
        });
    });

    // Close modal when clicking backdrop
    document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
        backdrop.addEventListener('click', function (e) {
            if (e.target === this) {
                closeModal(this);
            }
        });
    });

    // Open modal buttons
    document.querySelectorAll('[data-open-modal]').forEach(btn => {
        btn.addEventListener('click', function () {
            const modalId = this.getAttribute('data-open-modal');
            const modal = document.querySelector(modalId);
            if (modal) {
                openModal(modal);
            }
        });
    });
}

// Open modal
function openModal(modal) {
    modal.classList.add('active');
    document.body.classList.add('modal-open');
}

// Close modal
function closeModal(modal) {
    modal.classList.remove('active');
    document.body.classList.remove('modal-open');
}

// Setup dropdown functionality
function setupDropdowns() {
    document.querySelectorAll('.navbar-user, [data-dropdown]').forEach(dropdown => {
        const trigger = dropdown.querySelector('.navbar-user-trigger, [data-dropdown-trigger]');

        if (trigger) {
            trigger.addEventListener('click', (e) => {
                e.stopPropagation();

                // Close other dropdowns
                document.querySelectorAll('.navbar-user, [data-dropdown]').forEach(other => {
                    if (other !== dropdown) {
                        other.classList.remove('active');
                    }
                });

                dropdown.classList.toggle('active');
            });
        }
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', () => {
        document.querySelectorAll('.navbar-user, [data-dropdown]').forEach(dropdown => {
            dropdown.classList.remove('active');
        });
    });
}

// Setup tooltips (simple implementation)
function setupTooltips() {
    document.querySelectorAll('[data-tooltip]').forEach(el => {
        el.addEventListener('mouseenter', function () {
            const text = this.getAttribute('data-tooltip');
            const tooltip = document.createElement('div');
            tooltip.className = 'tooltip';
            tooltip.textContent = text;
            tooltip.style.position = 'absolute';
            tooltip.style.zIndex = '9999';

            this.appendChild(tooltip);

            // Position tooltip
            const rect = this.getBoundingClientRect();
            tooltip.style.top = (rect.top - tooltip.offsetHeight - 5) + 'px';
            tooltip.style.left = (rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2)) + 'px';
        });

        el.addEventListener('mouseleave', function () {
            const tooltip = this.querySelector('.tooltip');
            if (tooltip) {
                tooltip.remove();
            }
        });
    });
}

// Utility functions
const Utils = {
    // Scroll to element
    scrollTo(selector, offset = 0) {
        const element = document.querySelector(selector);
        if (element) {
            const top = element.offsetTop - offset;
            window.scrollTo({
                top,
                behavior: 'smooth'
            });
        }
    },

    // Format currency (Indonesian Rupiah)
    formatRupiah(number) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(number);
    },

    // Format date (Indonesian)
    formatDate(date) {
        return new Date(date).toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'long',
            year: 'numeric'
        });
    },

    // Debounce function
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

    // Copy to clipboard
    copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            LoadingStates.showToast('Berhasil disalin!', 'success', 2000);
        }).catch(() => {
            LoadingStates.showToast('Gagal menyalin', 'error', 2000);
        });
    }
};

// Export functions to global scope
window.openModal = openModal;
window.closeModal = closeModal;
window.Utils = Utils;

// Handle page unload (form protection)
let formChanged = false;

document.querySelectorAll('form').forEach(form => {
    // Skip registration form (has its own handler)
    if (form.id === 'registration-form') return;

    form.addEventListener('change', () => {
        formChanged = true;
    });

    form.addEventListener('submit', () => {
        formChanged = false;
    });
});

window.addEventListener('beforeunload', (e) => {
    if (formChanged) {
        e.preventDefault();
        e.returnValue = 'Anda memiliki perubahan yang belum disimpan. Yakin ingin meninggalkan halaman?';
    }
});

// Print functionality
window.print = function () {
    window.print();
};

// Back to top button
const backToTopBtn = document.createElement('button');
backToTopBtn.className = 'back-to-top';
backToTopBtn.innerHTML = '↑';
backToTopBtn.style.display = 'none';
document.body.appendChild(backToTopBtn);

window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
        backToTopBtn.style.display = 'block';
    } else {
        backToTopBtn.style.display = 'none';
    }
});

backToTopBtn.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});
