import {Modal} from 'bootstrap'

import Swal from 'sweetalert2'

function showSuccessAlert(title, message = null) {
    Swal.fire({
        icon: "success",
        title: title,
        text: message
    })
}

function showErrorAlert(title, message = null) {
    Swal.fire({
        icon: "error",
        title: title,
        text: message
    })
}

$(document).ready(function () {
    // Modal
    const modal = new Modal(document.getElementById('addNewItemModal'))


    // Delete item
    $('.delete-item').click(function (e) {
        e.preventDefault();

        const id = $(this).data('id');
        axios.delete(
            `/dashboard/${id}`
        ).then(_ => {
            $(`li[data-id=${id}]`).remove();
            showSuccessAlert("Item has been deleted successfully")
        }).catch(error => {
            console.log(error);
            showErrorAlert("Something went wrong", "Cannot Delete Item");
        })
    })

    // Add new Item
    $("#addNewItemForm").submit(function (_) {
        const content = $("input[name='content']");
        const status = $("select[name='status']").val();

        axios.post(
            "/dashboard",
            {
                content: content.val(),
                status: status,
            }
        ).then(response => {
            $(`ul[data-list="${status}"]`).append(response.data.data);
            content.val("")
            modal.hide();
            showSuccessAlert("Item has been added successfully")
        }).catch(error => {
            let message = (error.status === 422 && error.response.data.errors) ?
                Object.values(error.response.data.errors)
                    .flat()
                    .join(" ") : null;

            showErrorAlert("Cannot Add Item", message);
        })


        return false; // prevent submitting
    })
})
