$('.delete-btn').on('click', function() {
    let form = $('#' + $(this).data('id'));
    if (confirm('Are you sure you want to delete this note?')) {
        form.trigger('submit');
    }
});

$('#discard_note_btn').on('click', function() {
    if (confirm('Are you sure you want to discard your progress?')) {
        window.location = $(this).data('url');
    }
});

$('#save_note_btn').on('click', function() {
    $('#editor_form').trigger('submit');
});