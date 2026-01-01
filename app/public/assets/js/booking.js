// Wait for DOM to load
document.addEventListener('DOMContentLoaded', function() {
    console.log("Tutor Connect: Assets Loaded.");

    // Client-side validation for booking forms
    const bookingForm = document.querySelector('form[action="/book/payment"]');
    if (bookingForm) {
        bookingForm.addEventListener('submit', function(e) {
            // check if a time slot is selected here
            const timeSelect = document.querySelector('select[name="time"]');
            if (timeSelect && timeSelect.value === "") {
                e.preventDefault();
                alert("Please select a time slot.");
            }
        });
    }
});