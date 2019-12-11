/**
 * Forms utility library
 * Automatically converts a form into an ajax form
 * 
 * @author Iyiola-am
 */
var forms = (function ($) {
    let inputElements = 'input, select, textarea, radio, checkbox, button';

    function notify(content, title = 'Alert', al_type = 'info') {
        $.notify({
            title: '<strong>'+title+'</strong><br>',
            message: content
        },{
            allow_dismiss: true,
            type: al_type,
            placement: {
                from: 'top',
                align: 'right'
            },
            animate: {
                enter: 'animated fadeInRight',
                exit: 'animated fadeOutRight'
            }
        });
    }

    $('form.ajax-form').on('submit', function (e) {
        e.preventDefault();

        // Notification
        let notifyMsg = $(this).data('notifymsg');
        let silent = $(this).hasClass('ajax-form-silent');
        if (notifyMsg != null) {
            notify(notifyMsg, 'Please wait');
        } else if (!silent) {
            notify('Processing data...', 'Please wait');
        }

        // Get data and disable elements
        let form = $(this).trigger('submit:getdata');
        let data = new FormData(this);
        form.find(':disabled').addClass('ajax-form-element-disabled');
        form.find(inputElements).attr('disabled', true);

        // Send the ajax request
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            complete: function (response, status) {
                if (status == 'success') {
                    try {
                        response = JSON.parse(response.responseText);
                        if (response.ok == true) {
                            if (!silent) {
                                notify(response.message, 'Success', 'success');
                            }
                            setTimeout(function () {
                                if (response.data.redirect != null) {
                                    window.location = response.data.redirect;
                                } else if (form.data('redirect') != null) {
                                    window.location = form.data('redirect');
                                } else if (response.data.reload == true || form.data('reload') != null) {
                                    window.location.reload();
                                }
                            }, 2000);
                        } else if (!silent) {
                            notify(response.message, 'Something went wrong!', 'danger');
                        }
                    } catch (e) {
                        //
                    } finally {
                        form.trigger('submit:response:success', [response, status]);
                    }
                } else {
                    if (!silent) {
                        notify('An error occured while submitting the form!', 'This is bad', 'danger');
                    }
                    form.trigger('submit:response:error', [response, status]);
                }

                // Enable form elements
                form.find(inputElements).removeAttr('disabled');
                form.find('.ajax-form-element-disabled').removeClass('ajax-form-element-disabled').attr('disabled', true);

                // ON response event
                form.trigger('submit:response', [response, status]);
            }
        });
    });
})(jQuery);