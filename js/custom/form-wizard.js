(function ($) {
    "use strict";

    // Form Wizard
    if ($.isFunction($.fn.bootstrapWizard))
    {
        $('#rootwizard').bootstrapWizard({
            tabClass: 'nav wizard-steps',
            onTabShow: function ($tab, $navigation, index)
            {
                $tab.prevAll().addClass('completed');
                $tab.nextAll().removeClass('completed');
                $tab.removeClass('completed');
            }

        });

        $(".validate-form-wizard").each(function (i, formwizard)
        {
            var $this = $(formwizard);
            var $progress = $this.find(".steps-progress div");

            var $validator = $this.validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 3
                    },
                    password: {
                        required: true,
                        minlength: 3
                    },
                    confirmpassword: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true,
                        minlength: 3
                    }
                }
            });

            // Validation
            var checkValidaion = function (tab, navigation, index)
            {
                if ($this.hasClass('validate'))
                {
                    var $valid = $this.valid();
                    if (!$valid) {
                        $validator.focusInvalid();
                        return false;
                    }
                }

                return true;
            };

            $this.bootstrapWizard({
                tabClass: 'nav wizard-steps',
                onNext: checkValidaion,
                onTabClick: checkValidaion,
                onTabShow: function ($tab, $navigation, index)
                {
                    $tab.removeClass('completed');
                    $tab.prevAll().addClass('completed');
                    $tab.nextAll().removeClass('completed');
                }
            });
        });
    }

})(jQuery);