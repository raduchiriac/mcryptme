$(function() {
    $('.btn-encrypt').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "action.php",
            data: {
                action: "encrypt",
                key: $('#key1').val(),
                text: $('#plaintext').val()
            }
        }).done(function(msg) {
            outputAjax(msg);
        });
    });
    $('.btn-decrypt').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "action.php",
            data: {
                action: "decrypt",
                key: $('#key2').val(),
                text: $('#encryptedtext').val()
            }
        }).done(function(msg) {
            outputAjax(msg);
        });
    });

    var outputAjax = function(msg) {
        $('.reply').val(msg);
    }
});