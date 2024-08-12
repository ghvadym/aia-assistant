(function($){
    $(document).ready(function() {
        const ajax = aiajax.ajaxurl;
        const nonce = aiajax.nonce;

        const btnSubmit = $('.aia_form__submit');
        if (btnSubmit.length) {
            $(document).on('click', '.aia_form__submit', function () {
                const wrap = $(this).closest('.aia');

                if (!formValidation(wrap)) {
                    return false;
                }

                jQuery.ajax({
                    type       : 'POST',
                    url        : ajax,
                    data: {
                        action       : 'ai_prompt',
                        topic        : $(wrap).find('#aia-topic').val(),
                        keywords     : $(wrap).find('#aia-keywords').val(),
                        aia_voice    : $(wrap).find('#aia-tone-voice').val(),
                        lang         : $(wrap).find('#aia-language option:selected').val(),
                        point_of_view: $(wrap).find('#aia-point-of-view option:selected').val(),
                    },
                    beforeSend : function () {
                        $(wrap).addClass('_spinner');
                    },
                    success    : function (response) {
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

            const fields = $(wrap).find('input, select');

            if (!fields) {
                return false;
            }

            $(fields).each(function (i, item) {
                if (!$(this).val()) {
                    return false;
                }
            });

            return true;
        }
    });
})(jQuery);