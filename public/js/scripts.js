$('.delete-btn').on('click', function() {
    let form = $('#' + $(this).data('id'));
    if (confirm('Are you sure you want to delete this note?')) {
        form.trigger('submit');
    }
});