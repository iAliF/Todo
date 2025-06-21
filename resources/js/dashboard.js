import {Modal} from 'bootstrap'

$(document).ready(function () {
    // Configure select2
    $('.status-select').select2({
        placeholder: 'Status',
        closeOnSelect: true,
        dropdownParent: $('#addNewItemModal')
    });


    // Modal
    const modal = new Modal(document.getElementById('addNewItemModal'))

    $('.delete-item').click(function (e) {
        e.preventDefault();

        const id = $(this).data('id');
        axios.delete(
            `/dashboard/${id}`
        ).then(response => {
            $(`li[data-id=${id}]`).remove();
            // Todo => Notify
        })
            .catch(error => {
                // Todo => Handle
                console.log(error);
            })
    })

    $("#addNewItemForm").submit(function (e) {
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
        }).catch(error => {
            console.log(error);
            // TOdo => Handle
        })

        content.val("")
        modal.hide();
        return false; // prevent submitting
    })
})
