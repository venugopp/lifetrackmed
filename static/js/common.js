
$(document).ready(function () {
    $('#estimator-form-submit').on('click', function (event) {
        // Stop the default submit.
        event.preventDefault();

        // Reset on submit.
        $('.panel-success').hide();
        $('.panel-danger').hide();
        $('.form-group').removeClass('has-error');

        let numberofstudy = $('#numberofstudy').val();
        let studygrowth = $('#studygrowth').val();
        let forecast = $('#forecast').val();
        let isValid = true;

        // Validation.
        if (numberofstudy == '') {
            $('.numberofstudy').addClass('has-error');
            isValid = false;
        }
        if (studygrowth == '') {
            $('.studygrowth').addClass('has-error');
            isValid = false;
        }
        if (forecast == '') {
            $('.forecast').addClass('has-error');
            isValid = false;
        }

        // Show error message due to validation.
        if (!isValid) {
            $('.panel-danger .panel-body').html("Please fill in the required fields.");
            $('.panel-danger').show();
            $('.panel-danger div[tabindex=0]').focus();
            return false;
        }

        // Ajax call.
        $.ajax({
            url: "/index/calculate",
            method: "post",
            data: {
                numberofstudy: numberofstudy,
                studygrowth: studygrowth,
                forecast: forecast
            },
            success: function (result) {
                $('.panel-success .panel-body').html(result);
                $('.panel-success').show();
                $(".panel-success div[tabindex=0]").focus();
            },
            error: function (err) {
                $('.panel-danger .panel-body').html(err);
                $('.panel-danger').show();
                $('.panel-danger div[tabindex=0]').focus();
            }
        });
    });
});
