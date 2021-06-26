$(function() {
    get_data();
    scrollToEnd();
});


function get_data() {

    var group_task_id = $("#chat").attr('value');
    console.log(group_task_id);

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, 
        url: "/result/ajax/",
        dataType: "json",
        data: { 
            'group_task_id' : group_task_id
        },
        success: data => {
            $("#chat_view")
                .find(".chat_message")
                .remove();

            for (var i = 0; i < data.comments.length; i++) {
                var html = `
                <div class="chat_message chat_message_user" id="chat_message">
                <span class="chat_message_name ">${ data.comments[i].name }</span>
                <span class="chat_message_date">${ data.comments[i].created_at }</span>
                <div class="chat_message_mes">
                ${data.comments[i].comment}
                </div>
                </div>
            `;
            console.log(data.user.id);
            if(data.user.id != data.comments[i].user_id)
            {
                $(".chat_message").removeClass("chat_message_user");
            }
        
            $("#chat_view").append(html);
            }
        },        
        error: () => {
            // alert("ajax Error");
        }
    });

    setTimeout("get_data()", 5000);
}
// obj.scrollTop = obj.scrollHeight;
function scrollToEnd() {
    $.ajax({
        url: "/result/ajax/",
        dataType: "json",
        success: function() {        
            $('#chat_view').animate({ scrollTop: $('#chat_view')[0].scrollHeight});
        },        
        error: function() {
            // alert("ajax Error");
        }
    });
    setTimeout('scrollToEnd()',5000);
}

