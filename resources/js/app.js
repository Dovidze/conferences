import 'bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    const startTimeInput = document.getElementById('start_time');
    const endTimeInput = document.getElementById('end_time');

    // Set minimum start time to now
    const now = new Date();
    const formattedNow = now.toISOString().slice(0, 16); // Format to 'YYYY-MM-DDTHH:mm'
    startTimeInput.setAttribute('min', formattedNow);

    // Update end time min value based on selected start time
    startTimeInput.addEventListener('input', function () {
        const startTime = new Date(startTimeInput.value);

        // Calculate the minimum end time (next day)
        const nextDay = new Date(startTime);
        nextDay.setDate(startTime.getDate() + 1); // Set to next day

        // Set the min attribute for end time to the next day
        endTimeInput.setAttribute('min', nextDay.toISOString().slice(0, 16));

        // If the current end time is less than the new minimum, reset it
        if (new Date(endTimeInput.value) < nextDay) {
            endTimeInput.value = nextDay.toISOString().slice(0, 16);
        }
    });
});

