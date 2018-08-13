$(function () {

    let $messageList = $('#messages');
    let $name = $('#name');
    let $message = $('#message');

    $.ajax({
        type: 'GET',
        url: '/feed',
        success: function (messages) {
            let $pjm = $.parseJSON(messages);
            $.each($pjm, function (i, message) {
                $messageList.append('<li>' + message.name +
                    ':&nbsp;&nbsp;' + message.message + '&nbsp;&nbsp;' + '<br>' + message.time + '</li><br><br>')
            });
        }
    });

    $('#addMessage').on('click', function () {

        let newMessage = {
            name: $name.val(),
            message: $message.val(),
        };

        $message.val('');


        $.ajax({
            type: 'POST',
            url: '/feed',
            data: newMessage,
            success: function (messages) {
                let $pjm = $.parseJSON(messages);
                $messageList.empty();
                $.each($pjm, function (i, message) {
                    $messageList.append('<li>' + message.name +
                        ':&nbsp;&nbsp;' + message.message + '&nbsp;&nbsp;' + '<br>' + message.time + '</li><br><br>')
                });
            }
        })
    });
});