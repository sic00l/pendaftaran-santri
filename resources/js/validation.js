/* ============================================
   Form Validation Module
   Client-side validation untuk form pendaftaran
   ============================================ */

const FormValidator = {
    // Validation rules
    rules: {
        required: (value) => {
            return value.trim() !== '' || 'Field ini wajib diisi';
        },

        email: (value) => {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(value) || 'Format email tidak valid';
        },

        nik: (value) => {
            if (!/^\d{16}$/.test(value)) {
                return 'NIK harus 16 digit angka';
            }
            return true;
        },

        phone: (value) => {
            // Support format: 08xxx atau 628xxx
            if (!/^(08|628)\d{8,11}$/.test(value)) {
                return 'No HP tidak valid (contoh: 081234567890)';
            }
            return true;
        },

        minLength: (min) => (value) => {
            return value.length >= min || `Minimal ${min} karakter`;
        },

        maxLength: (max) => (value) => {
            return value.length <= max || `Maksimal ${max} karakter`;
        },

        age: (value) => {
            const today = new Date();
            const birthDate = new Date(value);
            const age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            if (age < 12 || age > 18) {
                return 'Usia harus antara 12-18 tahun';
            }
            return true;
        },

        fileSize: (maxSizeMB) => (file) => {
            if (!file) return true;
            const maxBytes = maxSizeMB * 1024 * 1024;
            return file.size <= maxBytes || `Ukuran file maksimal ${maxSizeMB}MB`;
        },

        fileType: (allowedTypes) => (file) => {
            if (!file) return true;
            return allowedTypes.includes(file.type) || `Tipe file harus: ${allowedTypes.join(', ')}`;
        },

        numeric: (value) => {
            return /^\d+$/.test(value) || 'Hanya boleh angka';
        },

        alpha: (value) => {
            return /^[a-zA-Z\s]+$/.test(value) || 'Hanya boleh huruf';
        },

        alphaNumeric: (value) => {
            return /^[a-zA-Z0-9\s]+$/.test(value) || 'Hanya boleh huruf dan angka';
        }
    },

    // Validate single field
    validateField(input, rules) {
        const value = input.type === 'file' ? input.files[0] : input.value;
        
        for (let rule of rules) {
            const result = rule(value);
            if (result !== true) {
                return result; // Return error message
            }
        }
        return true; // All rules passed
    },

    // Show error message
    showError(input, message) {
        this.clearError(input);
        
        input.classList.add('error');
        input.classList.remove('success');
        
        const errorEl = document.createElement('span');
        errorEl.className = 'form-error';
        errorEl.textContent = message;
        
        input.parentElement.appendChild(errorEl);
    },

    // Show success state
    showSuccess(input) {
        this.clearError(input);
        
        input.classList.add('success');
        input.classList.remove('error');
    },

    // Clear error message
    clearError(input) {
        input.classList.remove('error', 'success');
        
        const existingError = input.parentElement.querySelector('.form-error');
        if (existingError) {
            existingError.remove();
        }
    },

    // Setup real-time validation for an input
    setupRealTimeValidation(input, rules) {
        // Validate on blur
        input.addEventListener('blur', () => {
            const result = this.validateField(input, rules);
            if (result === true) {
                this.showSuccess(input);
            } else {
                this.showError(input, result);
            }
        });

        // Clear error on focus
        input.addEventListener('focus', () => {
            this.clearError(input);
        });

        // Validate on input (for immediate feedback)
        input.addEventListener('input', () => {
            if (input.classList.contains('error')) {
                const result = this.validateField(input, rules);
                if (result === true) {
                    this.showSuccess(input);
                }
            }
        });
    },

    // Validate entire form
    validateForm(formElement, validationConfig) {
        let isValid = true;
        const firstErrorField = null;

        for (let [fieldName, rules] of Object.entries(validationConfig)) {
            const input = formElement.querySelector(`[name="${fieldName}"]`);
            if (!input) continue;

            const result = this.validateField(input, rules);
            
            if (result === true) {
                this.showSuccess(input);
            } else {
                this.showError(input, result);
                isValid = false;
                
                if (!firstErrorField) {
                    firstErrorField = input;
                }
            }
        }

        // Scroll to first error
        if (firstErrorField) {
            firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstErrorField.focus();
        }

        return isValid;
    },

    // Initialize form validation
    init(formSelector, validationConfig) {
        const form = document.querySelector(formSelector);
        if (!form) return;

        // Setup real-time validation for each field
        for (let [fieldName, rules] of Object.entries(validationConfig)) {
            const input = form.querySelector(`[name="${fieldName}"]`);
            if (input) {
                this.setupRealTimeValidation(input, rules);
            }
        }

        // Validate on submit
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            
            if (this.validateForm(form, validationConfig)) {
                // Form is valid, can submit
                console.log('Form valid, submitting...');
                form.submit();
            }
        });
    }
};

// Example usage configuration for registration form
const registrationValidationConfig = {
    'nama_lengkap': [
        FormValidator.rules.required,
        FormValidator.rules.minLength(3),
        FormValidator.rules.alpha
    ],
    'nik': [
        FormValidator.rules.required,
        FormValidator.rules.nik
    ],
    'email': [
        FormValidator.rules.required,
        FormValidator.rules.email
    ],
    'no_hp': [
        FormValidator.rules.required,
        FormValidator.rules.phone
    ],
    'tanggal_lahir': [
        FormValidator.rules.required,
        FormValidator.rules.age
    ],
    'foto': [
        FormValidator.rules.required,
        FormValidator.rules.fileSize(2), // 2MB max
        FormValidator.rules.fileType(['image/jpeg', 'image/png', 'image/jpg'])
    ]
};

// Export for use in other modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = FormValidator;
}
