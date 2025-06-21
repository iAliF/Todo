const CSRF_TOKEN = $('input[name="_token"]')[0].value;

$('.delete-item').click(function (e) {
    e.preventDefault();

    const id = $(this).data('id');
    $.ajax({
        url: `dashboard/${id}`,
        type: 'DELETE',
        data: {
            _token: CSRF_TOKEN
        },
        success: function (res) {
            $(`li[data-id=${id}]`).remove();
        },
        error: function () {
            console.log('<<< ERROR >>>')
        }
    })
})
