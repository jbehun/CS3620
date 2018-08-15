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

    $('#clearMessage').on('click', function () {
        $message.val('');
    });

    $('#signIn').on('click', function () {

        let newUser = {
            name: $('#newUser').val(),
        };

        $.ajax({
            type: 'POST',
            url: '/user',
            data: newUser,
            success: function (user) {
                let $userInput = $('#userInput');
                $userInput.empty();
                let $pjm = $.parseJSON(user);
                $userInput.append('<h2>Hello ' + $pjm.name + '!</h2>'
                    + '<form>'
                    + '<p style="color: black">Name<BR><BR>'
                    + '<input type="text" id="name" value="'+ $pjm.name +'">'
                    + '</p>'
                    + '<p style="color: black">Message<BR><BR>'
                    + '<textarea style="width: 80%; height: 150px" id="message"></textarea>'
                    + '</p>'
                    + '</form>'
                    + '<button type="button" class="button" id="addMessage">Post</button>'
                    + '<button type="button" class="button" id="clearMessage">Clear</button>');

                $message = $('#message');
                $name = $('#name');

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

                $('#clearMessage').on('click', function () {
                    $message.val('');
                });
            }
        });

    });

    /*setInterval(function () {

        $.ajax({
            type: 'GET',
            url: '/feed',
            success: function (messages) {
                let $pjm = $.parseJSON(messages);
                $messageList.empty();
                $.each($pjm, function (i, message) {
                    $messageList.append('<li>' + message.name +
                        ':&nbsp;&nbsp;' + message.message + '&nbsp;&nbsp;' + '<br>' + message.time + '</li><br><br>')
                });
            }
        });
    }, 5000);*/
});