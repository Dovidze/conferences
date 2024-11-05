import 'bootstrap';
import Swal from 'sweetalert2';
window.Swal = Swal;

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

document.addEventListener('DOMContentLoaded', function() {
    // Registration Alert
    document.getElementById('registrationForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: SUCCESS,
            text: A_YOU_HAVE_REGISTERED,
            icon: 'success',
            timer: 2000,
            showConfirmButton: false,
            timerProgressBar: true
        }).then(() => {
            setTimeout(() => {
                e.target.submit();
            }, 100);
        });
    });

    // Unregistration Alert
    document.getElementById('unregistrationForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: SUCCESS,
            text: A_YOU_HAVE_UNREGISTERED,
            icon: 'success',
            timer: 2000,
            showConfirmButton: false,
            timerProgressBar: true
        }).then(() => {
            setTimeout(() => {
                e.target.submit();
            }, 100);
        });
    });
});


//FORM witch change role
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.update-role-button').forEach(button => {
        button.addEventListener('click', function (event) {
            const currentRoleId = this.getAttribute('data-role-id');
            const formId = this.getAttribute('data-form-id');
            const form = document.getElementById(formId);

            confirmRoleChange(event, currentRoleId, form);
        });
    });
});

// Function to accept changes (role)
function confirmRoleChange(event, currentRoleId, form) {
    const selectElement = form.querySelector('select[name="role_id"]');
    const newRoleId = selectElement.value;

    if (currentRoleId === '3' && newRoleId !== '3') {
        event.preventDefault();

        Swal.fire({
            text: ARE_YOU_SURE_TO_CHANGE_ROLE,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: YES,
            cancelButtonText: CANCEL
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: A_SUCCESS_ROLE_UPDATE,
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    form.submit();
                });
            }
        });
    } else {
        Swal.fire({
            icon: 'success',
            title: A_SUCCESS_ROLE_UPDATE,
            timer: 2000,
            showConfirmButton: false
        }).then(() => {
            form.submit();
        });
    }
}

// Delete/destroy conf Alert
document.querySelectorAll('.delete-button').forEach(button => {
    button.addEventListener('click', function() {
        const form = this.closest('form');

        Swal.fire({
            title: A_CONFERENCE_CONFIRM_DELETE,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: YES_DELETE,
            cancelButtonText: CANCEL
        }).then((result) => {
            if (result.isConfirmed) {
                // Alert about successful event (delete)
                Swal.fire({
                    title: A_CONFERENCE_DELETED_SUCCESSFULLY,
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    form.submit();
                });
            }
        });
    });
});
