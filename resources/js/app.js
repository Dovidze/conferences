import 'bootstrap';
import Swal from 'sweetalert2';
function showSuccessMessage(message) {
    Swal.fire({
        title: 'Sėkminga!',
        text: message,
        icon: 'success',
        confirmButtonText: 'Gerai'
    });
}

function showErrorMessage(message) {
    Swal.fire({
        title: 'Klaida!',
        text: message,
        icon: 'error',
        confirmButtonText: 'Uždaryti'
    });
}
