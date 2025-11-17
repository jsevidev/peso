document.querySelectorAll(".date-input").forEach(input => {
    input.addEventListener("change", function () {
        const label = this.previousElementSibling;

        if (this.value) {
            this.classList.add("has-value");
            label.style.opacity = "0"; // hide label
        } else {
            this.classList.remove("has-value");
            label.style.opacity = "1"; // show label
        }
    });
});


// 👉 NEW: make the whole pill open the date picker
document.querySelectorAll(".date-wrapper").forEach(wrapper => {
    const input = wrapper.querySelector(".date-input");
    wrapper.addEventListener("click", () => {
        // if browser supports showPicker(), use it
        if (input && typeof input.showPicker === "function") {
            input.showPicker();
        } else if (input) {
            // fallback for older browsers
            input.focus();
            input.click();
        }
    });
});

// CLEAR BUTTON FUNCTIONALITY
document.querySelector(".filter-clear").addEventListener("click", () => {
    document.querySelectorAll(".date-wrapper").forEach(wrapper => {
        const input = wrapper.querySelector(".date-input");
        const label = wrapper.querySelector(".date-label");

        // Reset the input value
        input.value = "";

        // Remove selected-state class
        input.classList.remove("has-value");

        // Reset label text based on ID
        if (input.id === "date-from") {
            label.textContent = "Date From";
        } else if (input.id === "date-to") {
            label.textContent = "Date To";
        }

        // Show label again
        label.style.opacity = "1";
    });
});

