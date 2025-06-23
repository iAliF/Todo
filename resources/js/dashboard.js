import {Modal} from 'bootstrap';

import Swal from 'sweetalert2';

function showSuccessAlert(title, message = null) {
    Swal.fire({
        icon: "success",
        title: title,
        text: message
    });
}

function showErrorAlert(title, message = null) {
    Swal.fire({
        icon: "error",
        title: title,
        text: message
    });
}

function getFormData(form) {
    const content = form.find("input[name='content']");
    const status = form.find("select[name='status']").val();

    return {content, status};
}

const useFormHelper = (formId, makeRequest, callback, modalObject, successMsg, errorMsg) => {
    $(formId).submit(function (_) {
        let {content, status} = getFormData($(this));

        try {
            makeRequest({content: content.val(), status: status})
                .then(response => {
                    callback({content, status, response: response.data});
                    content.val("");
                    modalObject.hide();
                    showSuccessAlert(successMsg);
                })
                .catch(error => {
                    let message = (error.status === 422 && error.response.data.errors) ?
                        Object.values(error.response.data.errors)
                            .flat()
                            .join(" ") : null;

                    showErrorAlert(errorMsg, message);
                });
        } catch (e) {
            console.log(e);
        }


        return false; // prevent submitting
    });
};

$(document).ready(function () {
    // Modal
    const addModal = new Modal(document.getElementById('addNewItemModal'));
    const editModal = new Modal(document.getElementById('editItemModal'));
    let currentItem; // ID of editing item


    // Delete item
    $('ul').on('click', '.delete-item', function (e) {
        e.preventDefault();

        const id = $(this).data('id');
        axios.delete(
            `/dashboard/${id}`
        ).then(_ => {
            $(`li[data-id=${id}]`).remove();
            showSuccessAlert("Item has been deleted successfully");
        }).catch(error => {
            console.log(error);
            showErrorAlert("Something went wrong", "Cannot Delete Item");
        });
    });

    // Add new Item form in modal
    useFormHelper(
        "#addNewItemForm",
        (data) => axios.post("/dashboard", data),
        ({status, response}) => $(`ul[data-list="${status}"]`).append(response.data),
        addModal,
        "Item has been added successfully",
        "Cannot Add Item"
    );

    // Edit item button click
    $(".edit-item").click(function (e) {
        e.preventDefault();

        currentItem = $(this).data('id');
        const currentLi = $(`li[data-id='${currentItem}']`);
        const content = currentLi.find("h6");
        const status = currentLi.closest("[data-list]").data('list');

        $('#editItemModal input[name="content"]').val(content.text());
        $('#editItemModal select[name="status"]').val(status);

        editModal.show();
    });

    // Edit Item
    useFormHelper(
        "#editItemForm",
        (data) => axios.patch(`/dashboard/${currentItem}`, data),
        ({status, response}) => {
            let li = $(`li[data-id='${currentItem}']`);
            const currentStatus = li.closest("[data-list]").data('list');

            if (currentStatus !== status) {
                li.remove();
                $(`ul[data-list="${status}"]`).append(response.data);
            } else {
                li.replaceWith(response.data);
            }
        },
        editModal,
        "Item has been edited successfully",
        "Cannot Edit Item"
    );
});
