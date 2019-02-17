$(document).ready(function () {
    var ip = document.domain;
    var host = 'ws://' + ip + ':8182';
    var socket = new WebSocket(host);

    socket.onmessage = function (tweet) {
        var obj = jQuery.parseJSON(tweet.data);
        console.log(obj);
        var tweetHTML = $(".tweet_template .elem").clone();

        tweetHTML.find('img.avatar').attr("src", obj.userAvatar);
        tweetHTML.find('.elem').attr("id", obj.id);
        tweetHTML.find('.tweet_link').attr("href", obj.link);
        tweetHTML.find('.user_name').text(obj.userName);
        tweetHTML.find('.user_text').text(obj.text);
        tweetHTML.find('.tweet_date').text(obj.date);

        $('#results').prepend(tweetHTML);

        if ($('.elem').length > 25) {
            $('#results').find('.elem:last').remove();
        }
    };
});

