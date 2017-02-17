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
                html += '<a href="' + val.url + '" target="_blank">';
                html += '<article class="6u 12u$(3) work-item">';
                html += '<img style="width:312px;height: 182px" src="' + val.img_src + '" alt="" />';
                html += '<h3>' + val.title + '</h3>';
                html += '<p>' + val.content + '</p>';
                html += '</article>';
                html += '</a>';
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
                html += '<a href="' + val.url + '" target="_blank">';
                html += '<h4>' + val.title + '</h4>';
                html += '<p>' + val.content + '</p>';
                html += '</a>';

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
//$("#submit_content").click(function(){
//    var obj = $("#contact_form");
//    var url = $(this).attr("src");
//    var data=new FormData(obj[0]);
//    $.ajax({
//        url: url,
//        type: 'POST',
//        cache: false,
//        data: data,
//        timeout : 5000,
//        processData: false, //告诉jQuery不要去处理发送的数据
//        contentType: false  //告诉jQuery不要去设置Content-Type请求头
//    }).done(function(res) {
//        alert("成功");
//        var src = $("#reset-form").attr("src");
//        $("#contractForm").load(src);
//        return false;
//    }).fail(function(res) {
//        alert('网络繁忙');
//    });
//})
//$("#reset-form").click(function(){
//    var src = $(this).attr("src");
//    $("#contractForm").load(src);
//})
$("#contractForm").load("/index.php?r=site/contact");
$(document).on("click","#reset-form",function(){
    var src = $(this).attr("src");
    $("#contractForm").load(src);
})
$(document).on("click","#submit_content",function(){
    var obj = $("#contact_form");
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
        alert("成功");
        //var src = $("#reset-form").attr("src");
        //var html = "留言成功";
        //$("#success-msg").html(html);
        //$("#success-msg").show();
        //$("#contractForm").hide();
        //successMsg();
        return false;
    }).fail(function(res) {
        alert('网络繁忙');
    });
})
//function successMsg()
//{
//    $("#success-msg").hide();
//    $("#contractForm").show();
//}

var title = "@记录平时遇到的问题和积累相关项目经验";
var href = window.location.href;


$(document).on("click",".x-share-xlwb, .h-article-xlwb",function(){
    if($(".n-lst-style1").length>0 || $('.n-lst-style2').length>0){
        href = $(this).parents("li").attr("data-url");
        sina(href,title)
    }else{
        sina(href,title)
    }
});
$(document).on("click",".x-share-db, .h-article-db",function(){
    if($(".n-lst-style1").length>0 || $('.n-lst-style2').length>0){
        href = $(this).parents("li").attr("data-url")
        renren(href,title)
    }else{
        renren(href,title)
    }
});
$(document).on("click",".x-share-txwb, .h-article-txwb",function(){
    if($(".n-lst-style1").length>0 || $('.n-lst-style2').length>0){
        href = $(this).parents("li").attr("data-url")
        qq(href,title)
    }else{
        qq(href,title)
    }
});
$(document).on("click",".x-share-kj, .h-article-kj",function(){

    if($(".n-lst-style1").length>0 || $('.n-lst-style2').length>0){
        href = $(this).parents("li").attr("data-url");
        qqSpace(href,title)
    }else{
        qqSpace(href,title)
    }
});
$(document).on("click",".x-share-wx , .h-article-wx",function() {
    if ($(".n-lst-style1").length > 0 || $('.n-lst-style2').length > 0) {
        href = $(this).parents("li").attr("data-url");
    }
    code(href);
    var renderType = window.navigator.userAgent.indexOf("Chrome") > 0 ? "canvas" : "table";

    function code(e) {
        $("body").append('<div class="m-qrcodeWap"><p class=" btm10"><span class="fr close">X</span><span>分享到微信</span></p><div class="cont center"></div><p class="f12">打开微信，点击底部的"发现"<br/>使用"扫一扫"即可将网页分享至朋友圈。</p></div>');
        $('.m-qrcodeWap .cont').qrcode({
            render: renderType,
            text: e,
            width: 200,
            height: 200
        });
        if ($(".l-canvas").size() <= 0) {
            $("body").append('<div class="l-canvas"></div>');
        }
    }
})



var qq = function (url,title) { //QQ
        window.open("http://v.t.qq.com/share/share.php?title=" + encodeURIComponent(title) + "&info=" + "&url=" + encodeURIComponent(url), "_blank");
    },
    qqSpace = function(url,title){//qq空间
        window.open("http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=" + encodeURIComponent(url)+"&title="+encodeURIComponent(title), "_blank");
    },
    sina = function (url,title) { //新浪
        window.open('http://v.t.sina.com.cn/share/share.php?title=' + encodeURIComponent(title) + "&info=" + '&url=' + encodeURIComponent(url) + '&source=bookmark', "_blank");
    },
    renren = function (url,title) { //人人
        window.open('http://share.renren.com/share/buttonshare.do?link='+ encodeURIComponent(url) + encodeURIComponent(title) + "&info=" + '&url=' + encodeURIComponent(url), "_blank");
    },
    douban = function (url,title) { //多看
        window.open('http://www.douban.com/recommend/?url=' + encodeURIComponent(url) + "&info=" + '&title=' + encodeURIComponent(url), "douban");
    },
    wangyi = function(url,title) { //网易
        window.open('http://t.163.com/article/user/checkLogin.do?title=' + encodeURIComponent(title) + '&url=' + encodeURIComponent(url), "_blank");
    },
    facebook = function(url,title) { //脸书
        window.open("https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(url) + "&title=" + encodeURIComponent(title), "_blank");
    };
    //toQQ = function() {//在线qq留言
    //    window.open("http://connect.qq.com/widget/shareqq/index.html?url=http://192.168.83.213:8082/tzweb/account/register?recommendPhone="+$('#phone').val()+"&desc=&title=自从加入 @360投资，收益高了，红包多了，一口气本金翻翻还不费劲，谁用谁知道！&summary=&pics=http://192.168.83.213:8082/tzweb/login/showImg?filePath=E:/mmt/images/sdc_02.jpg&flash=&site=&style=201&width=32&height=32",'_blank');
    //}