/* ============================================
   Multi-Step Form Module
   Navigation dan management untuk form multi-step
   ============================================ */

const MultiStepForm = {
    currentStep: 1,
    totalSteps: 5,
    formData: {},

    // Initialize multi-step form
    init(formSelector) {
        this.form = document.querySelector(formSelector);
        if (!this.form) {
            console.warn('Form not found');
            return;
        }

        this.totalSteps = this.form.querySelectorAll('.form-step').length;
        this.attachEventListeners();
        this.showStep(1);
        this.updateProgress();
    },

    // Attach event listeners
    attachEventListeners() {
        // Next buttons
        const nextButtons = this.form.querySelectorAll('[data-next]');
        nextButtons.forEach(btn => {
            btn.addEventListener('click', () => this.nextStep());
        });

        // Previous buttons
        const prevButtons = this.form.querySelectorAll('[data-prev]');
        prevButtons.forEach(btn => {
            btn.addEventListener('click', () => this.prevStep());
        });

        // Step indicator clicks
        const indicators = this.form.querySelectorAll('.step-indicator-item');
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                if (indicator.classList.contains('completed')) {
                    this.goToStep(index + 1);
                }
            });
        });

        // Form submission
        this.form.addEventListener('submit', (e) => {
            e.preventDefault();
            this.submitForm();
        });
    },

    // Show specific step
    showStep(stepNumber) {
        // Hide all steps
        const steps = this.form.querySelectorAll('.form-step');
        steps.forEach(step => {
            step.classList.remove('active');
        });

        // Show current step
        const currentStepEl = this.form.querySelector(`#step-${stepNumber}`);
        if (currentStepEl) {
            currentStepEl.classList.add('active');
            this.currentStep = stepNumber;
            this.updateStepIndicators();
            this.updateProgress();

            // Scroll to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    },

    // Go to specific step
    goToStep(stepNumber) {
        if (stepNumber >= 1 && stepNumber <= this.totalSteps) {
            this.showStep(stepNumber);
        }
    },

    // Next step
    nextStep() {
        if (!this.validateCurrentStep()) {
            return;
        }

        this.saveStepData();

        if (this.currentStep < this.totalSteps) {
            this.markStepAsCompleted(this.currentStep);
            this.showStep(this.currentStep + 1);
        }
    },

    // Previous step
    prevStep() {
        if (this.currentStep > 1) {
            this.showStep(this.currentStep - 1);
        }
    },

    // Validate current step
    validateCurrentStep() {
        const currentStepEl = this.form.querySelector(`#step-${this.currentStep}`);
        if (!currentStepEl) return true;

        const requiredInputs = currentStepEl.querySelectorAll('[required]');
        let isValid = true;
        let firstInvalidField = null;

        requiredInputs.forEach(input => {
            const value = input.type === 'checkbox' ? input.checked : input.value.trim();

            if (!value) {
                this.showFieldError(input, 'Field ini wajib diisi');
                isValid = false;

                if (!firstInvalidField) {
                    firstInvalidField = input;
                }
            } else {
                this.clearFieldError(input);
            }
        });

        if (!isValid && firstInvalidField) {
            firstInvalidField.focus();
            firstInvalidField.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        return isValid;
    },

    // Save step data
    saveStepData() {
        const currentStepEl = this.form.querySelector(`#step-${this.currentStep}`);
        if (!currentStepEl) return;

        const inputs = currentStepEl.querySelectorAll('input, select, textarea');

        inputs.forEach(input => {
            if (input.type === 'radio') {
                if (input.checked) {
                    this.formData[input.name] = input.value;
                }
            } else if (input.type === 'checkbox') {
                this.formData[input.name] = input.checked;
            } else if (input.type === 'file') {
                if (input.files.length > 0) {
                    this.formData[input.name] = input.files[0];
                }
            } else {
                this.formData[input.name] = input.value;
            }
        });

        // If this is the review step, populate review data
        if (this.currentStep === this.totalSteps - 1) {
            this.populateReviewData();
        }
    },

    // Populate review data
    populateReviewData() {
        for (let [key, value] of Object.entries(this.formData)) {
            const reviewEl = this.form.querySelector(`[data-review="${key}"]`);
            if (reviewEl) {
                if (value instanceof File) {
                    reviewEl.textContent = value.name;
                } else if (typeof value === 'boolean') {
                    reviewEl.textContent = value ? 'Ya' : 'Tidak';
                } else {
                    reviewEl.textContent = value || '-';
                }
            }
        }
    },

    // Mark step as completed
    markStepAsCompleted(stepNumber) {
        const indicator = this.form.querySelector(`.step-indicator-item:nth-child(${stepNumber})`);
        if (indicator) {
            indicator.classList.add('completed');
        }
    },

    // Update step indicators
    updateStepIndicators() {
        const indicators = this.form.querySelectorAll('.step-indicator-item');

        indicators.forEach((indicator, index) => {
            const stepNum = index + 1;

            indicator.classList.remove('active');

            if (stepNum === this.currentStep) {
                indicator.classList.add('active');
            }
        });
    },

    // Update progress bar
    updateProgress() {
        const percentage = ((this.currentStep - 1) / (this.totalSteps - 1)) * 100;
        const progressBar = this.form.querySelector('.form-progress-bar');

        if (progressBar) {
            progressBar.style.width = `${percentage}%`;
        }

        // Update progress text
        const progressText = this.form.querySelector('.progress-text');
        if (progressText) {
            progressText.textContent = `Step ${this.currentStep} dari ${this.totalSteps}`;
        }
    },

    // Show field error
    showFieldError(input, message) {
        input.classList.add('error');

        let errorEl = input.parentElement.querySelector('.form-error');
        if (!errorEl) {
            errorEl = document.createElement('span');
            errorEl.className = 'form-error';
            input.parentElement.appendChild(errorEl);
        }
        errorEl.textContent = message;
    },

    // Clear field error
    clearFieldError(input) {
        input.classList.remove('error');

        const errorEl = input.parentElement.querySelector('.form-error');
        if (errorEl) {
            errorEl.remove();
        }
    },

    // Submit form
    submitForm() {
        console.log('Submitting form with data:', this.formData);

        // Show loading state
        const submitBtn = this.form.querySelector('[type="submit"]');
        if (submitBtn) {
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;
        }

        // Create FormData object
        const formData = new FormData(this.form);

        // Submit via AJAX
        fetch(this.form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Redirect to success page
                    window.location.href = data.redirect || '/registration/success';
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan');
                }
            })
            .catch(error => {
                console.error('Form submission error:', error);
                alert('Terjadi kesalahan saat mengirim data. Silakan coba lagi.');

                // Remove loading state
                if (submitBtn) {
                    submitBtn.classList.remove('loading');
                    submitBtn.disabled = false;
                }
            });
    },

    // Save progress to localStorage
    saveProgress() {
        localStorage.setItem('registration_progress', JSON.stringify({
            step: this.currentStep,
            data: this.formData
        }));
    },

    // Load progress from localStorage
    loadProgress() {
        const saved = localStorage.getItem('registration_progress');
        if (saved) {
            const { step, data } = JSON.parse(saved);
            this.currentStep = step;
            this.formData = data;

            // Populate form fields with saved data
            for (let [key, value] of Object.entries(data)) {
                const input = this.form.querySelector(`[name="${key}"]`);
                if (input && !(value instanceof File)) {
                    if (input.type === 'radio') {
                        const radio = this.form.querySelector(`[name="${key}"][value="${value}"]`);
                        if (radio) radio.checked = true;
                    } else if (input.type === 'checkbox') {
                        input.checked = value;
                    } else {
                        input.value = value;
                    }
                }
            }

            this.showStep(step);
        }
    },

    // Clear saved progress
    clearProgress() {
        localStorage.removeItem('registration_progress');
    },

    // Add edit functionality for review step
    setupEditLinks() {
        const editLinks = this.form.querySelectorAll('[data-edit-step]');
        editLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const stepNum = parseInt(link.getAttribute('data-edit-step'));
                this.goToStep(stepNum);
            });
        });
    }
};

// Auto-initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#registration-form');
    if (form) {
        MultiStepForm.init('#registration-form');
        MultiStepForm.setupEditLinks();

        // Optional: Load saved progress
        // MultiStepForm.loadProgress();
    }
});

// Export for use in other modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = MultiStepForm;
}
