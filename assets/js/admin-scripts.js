(function($){
    $(document).ready(function() {
        const ajax = aiajax.ajaxurl;
        const nonce = aiajax.nonce;

        const btnSubmit = $('.aia_form__submit');
        if (btnSubmit.length) {
            $(document).on('click', '.aia_form__submit', function () {
                const btn = $(this);
                const wrap = $(btn).closest('.aia');
                const responseField = $(wrap).find('.aia__response');
                const errorMessage = $(wrap).find('.aia__error');

                if (!formValidation(wrap)) {
                    scrollToEl('#aia-fields');
                    return false;
                }

                jQuery.ajax({
                    type       : 'POST',
                    url        : ajax,
                    data: {
                        action       : 'ai_prompt',
                        id           : $(btn).data('id'),
                        type         : $(btn).data('type'),
                        topic        : $(wrap).find('#aia-topic').val(),
                        keywords     : $(wrap).find('#aia-keywords').val(),
                        voice        : $(wrap).find('#aia-tone-voice').val(),
                        words        : $(wrap).find('#aia-words-count').val(),
                        lang         : $(wrap).find('#aia-language option:selected').val(),
                        point_of_view: $(wrap).find('#aia-point-of-view option:selected').val(),
                    },
                    beforeSend : function () {
                        $(wrap).addClass('_spinner');
                    },
                    success    : function (response) {
                        if (response.success) {
                            if (response.answer) {
                                $(responseField).html(response.answer);
                                $(errorMessage).empty();
                            }
                        }

                        if (response.error) {
                            if (response.message) {
                                $(responseField).empty();
                                $(errorMessage).html(response.message);
                            }
                        }

                        $(wrap).removeClass('_spinner');
                    },
                    error      : function (err) {
                        console.log('error', err);
                    }
                });
            });
        }

        function formValidation(wrap)
        {
            if (!wrap) {
                return;
            }

            let notValidFields = 0;
            const fields = $(wrap).find('input, select');
            const requiredFields = [
                'aia-topic'
            ];

            if (!fields) {
                return false;
            }

            $(fields).each(function (i, item) {
                const inputName = $(this).attr('name');

                if (!$(this).val()) {
                    if (jQuery.inArray(inputName, requiredFields) !== -1) {
                        $(this).addClass('not_valid');
                        notValidFields++;
                    }
                } else {
                    if (jQuery.inArray(inputName, requiredFields) !== -1) {
                        $(this).removeClass('not_valid');
                    }
                }
            });

            return !notValidFields;
        }

        function scrollToEl(selector)
        {
            if (!selector) {
                return;
            }

            $([document.documentElement, document.body]).animate({
                scrollTop: $(selector).offset().top
            }, 500);
        }
    });
})(jQuery);