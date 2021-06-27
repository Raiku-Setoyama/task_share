"use strict";

$(function(){
        $(".wheel-button").wheelmenu({
            trigger: "hover", //click" or "hover . Default: "click" どのアクションで開かせるか
            animation: "fly", //"fade" or "fly". Default: "fade" 表示方法
            animationSpeed: "slow", //"instant", "fast", "medium", or "slow". Default: "medium" スピード
            angle: "all" //"all", "N", "NE", "E", "SE", "S", "SW", "W", "NW", or even array [0, 360]. Default: "all" or [0, 360] 表示角度
        });

$(".drag").draggable();
$(".container").droppable({
    accept: ".drag",

    drop: function( event, ui ) {

            // position of the draggable minus position of the droppable
            // relative to the document
            var newPosX = ui.offset.left - $(this).offset().left;
            var newPosY = ui.offset.top - $(this).offset().top;
    
            var windowX = $(window).outerWidth(true);
            var windowY = $(window).outerHeight(true);
            
    // 高さ.横幅の値をbodyの高さと横で割って%で表す
    // レスポンシブ対応として

    var $perX = newPosX/windowX*100;
    var $perY = newPosY/windowY*100;

    // ドラッグした要素のidを取得
    var $id = ui.draggable.attr('value');
    
    $.ajax({
        headers: {
            // csrf登録しないとダメ
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, 
        type: "POST",
        url: "/position",
        data: { 
            'perX' : $perX,
            'perY' : $perY,
            "id" : $id
        },
        success : function($res) {
            console.log($res);
        },
        //処理がエラーであれば
        error : function() {
            alert('通信エラー');
        }
    });
}
});

$(".group-drag").draggable();
$("body").droppable({
    accept: ".group-drag",

    drop: function( event, ui ) {

            // position of the draggable minus position of the droppable
            // relative to the document
            var newPosX = ui.offset.left - $(this).offset().left;
            var newPosY = ui.offset.top - $(this).offset().top;
    
            var windowX = $(window).outerWidth(true);
            var windowY = $(window).outerHeight(true);
            
    // 高さ.横幅の値をbodyの高さと横で割って%で表す
    // レスポンシブ対応として

    var $perX = newPosX/windowX*100;
    var $perY = newPosY/windowY*100;

    // ドラッグした要素のidを取得
    var $id = ui.draggable.attr('value');
    
    $.ajax({
        headers: {
            // csrf登録しないとダメ
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, 
        type: "POST",
        url: "/position/group",
        data: { 
            'perX' : $perX,
            'perY' : $perY,
            "id" : $id
        },
        success : function($res) {
            console.log($res);
        },
        //処理がエラーであれば
        error : function() {
            alert('通信エラー');
        }
    });
}
});
});

$("#group_delete").on('click',function(){
    
    var $result = confirm('本当にグループを削除しますか？');

    if($result)
    {
        var $group_id = $("#group_delete").attr('value');

        $.ajax({
            headers: {
                // csrf登録しないとダメ
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, 
            type: "POST",
            url: "/group/delete",
            data: { 
                'group_id' : $group_id
            },
            success : function($res) {
                console.log($res);
            },
            //処理がエラーであれば
            error : function() {
                alert('通信エラー');
            }
        });
    }
})

$(".btn-complete-task").on('click',function(){
    $(".container").addClass('move-right');
    $(".complete_task_list").addClass('display_block');
})
$(".complete_task_list").on('click',function(){
    $(".container").removeClass('move-right');
    $(".complete_task_list").removeClass('display_block');
})
$(".btn-member").on('click',function(){
    $(".container").toggleClass('move-left');
    $(".member_list").toggleClass('display_block');
})
$(".member_list_btn").on('click',function(){
    $(".member_table").toggleClass('display_block');
})


