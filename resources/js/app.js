import 'bootstrap';

// Conferences create calendar date script
document.addEventListener('DOMContentLoaded', function () {
    const startTimeInput = document.getElementById('start_time');
    const endTimeInput = document.getElementById('end_time');

    if (startTimeInput && endTimeInput) {
        const now = new Date();
        const formattedNow = now.toISOString().slice(0, 16);
        startTimeInput.setAttribute('min', formattedNow);

        startTimeInput.addEventListener('input', function () {
            const startTime = new Date(startTimeInput.value);

            // Calculate the minimum end time (1day)
            const nextDay = new Date(startTime);
            nextDay.setDate(startTime.getDate() + 1); // Set to next day

            // Set the min attribute for end time to the next day
            endTimeInput.setAttribute('min', nextDay.toISOString().slice(0, 16));

            // If the current end time is less than the new minimum, reset it
            if (new Date(endTimeInput.value) < nextDay) {
                endTimeInput.value = nextDay.toISOString().slice(0, 16);
            }
        });
    }
});

// Conferences edit calendar date script


