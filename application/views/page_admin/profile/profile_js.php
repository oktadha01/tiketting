<script>
$(function() {
    // photo upload
    $('#btn-upload-photo').on('click', function() {
        $(this).siblings('#filePhoto').trigger('click');
    });

    // plans
    $('.btn-choose-plan').on('click', function() {
        $('.plan').removeClass('selected-plan');
        $('.plan-title span').find('i').remove();

        $(this).parent().addClass('selected-plan');
        $(this).parent().find('.plan-title').append('<span><i class="fa fa-check-circle"></i></span>');
    });
});
</script>