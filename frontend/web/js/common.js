/**
 * Created by cm on 2017/2/3.
 */
$("#next_page").click(function(){
    var p = $(this).attr("page");
    //var url = $(this).attr("url");
    //var csrf = $("#id_csrf").val();
    //$.ajax({
    //    type : 'post',
    //    url : url,
    //    data : {'p':p,'_csrf':csrf},
    //    dataType : 'json',
    //    success : function(){
    //        alert(1);
    //    }
    //})
    //$.ajax({
    //    type: "POST",
    //    data:$('#form').serialize(),
    //    async: false,
    //    dataType:'json',
    //    error: function(request) {
    //        alert（data.message）；
    //    },
    //    success: function(data) {
    //        layer.msg(data.message,{icon:data.code?6:5,time:1000},function(){
    //            alert(data.message);
    //        });
    //    }
    //});
    var obj = $("#page_action");
    var url = $(this).attr("src");
    var data=new FormData(obj[0]);
    $.ajax({
        url: url,
        type: 'POST',
        cache: false,
        data: data,
        timeout : 5000,
        processData: false, //告诉jQuery不要去处理发送的数据
        contentType: false  //告诉jQuery不要去设置Content-Type请求头
    }).done(function(res) {
        var html = '';
        if(res.data != '') {
            $.each(res.data, function (key, val) {
                html += '<article class="6u 12u$(3) work-item">';
                html += '<a href="images/fulls/01.jpg" class="image fit thumb"><img style="width:312px;height: 182px" src="' + val.img_src + '" alt="" /></a>';
                html += '<h3>' + val.title + '</h3>';
                html += '<p>' + val.content + '</p>';
                html += '</article>';
            })
            $("#pic_list").append(html);
            p++;
            $("#page_data").val(p);
        }else{
            $("#next_page").text("没有更多加载");
        }
    }).fail(function(res) {
        alert('网络繁忙');
    });
})

$("#next_art_page").click(function(){
    var p = $(this).attr("page");
    var obj = $("#page_art_action");
    var url = $(this).attr("src");
    var data=new FormData(obj[0]);
    $.ajax({
        url: url,
        type: 'POST',
        cache: false,
        data: data,
        timeout : 5000,
        processData: false, //告诉jQuery不要去处理发送的数据
        contentType: false  //告诉jQuery不要去设置Content-Type请求头
    }).done(function(res) {
        var html = '';
        if(res.data != '') {
            $.each(res.data, function (key, val) {
                html += '<h4>' + val.title + '</h4>';
                html += '<p>' + val.content + '</p>';

            })
            $("#art_list").append(html);
            p++;
            $("#page_art_data").val(p);
        }else{
            $("#next_art_page").text("没有更多加载");
        }
    }).fail(function(res) {
        alert('网络繁忙');
    });
})