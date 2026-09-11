function toggleOptions(id) {
    // Hide all option groups
    const options = document.querySelectorAll('.options');
    options.forEach(option => {
        option.classList.add('hidden');
    });

    // Show the selected option group
    const selectedOptions = document.getElementById(id);
    if (selectedOptions) {
        selectedOptions.classList.toggle('hidden');
    }
}


