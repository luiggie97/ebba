$(document).ready(function () {
    //CPF Mask
    $('#cpf').mask('000.000.000-00');

    //Custom File uploader
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
});
