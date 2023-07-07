import * as Swal from "sweetalert2"

export const sweetAlert = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-primary btn-lg px-2 mt-4 mb-5 w-50',
        cancelButton: 'btn btn-danger btn-lg px-2 mt-4 mb-5 w-50'
    },
    buttonsStyling: false
})
