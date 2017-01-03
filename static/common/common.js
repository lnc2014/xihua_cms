/**
 * Created by admin on 2017/1/2.
 * 公共js类库
 */
/**
 * ace自带的错误信息
 * @param class_name
 * @param second_class_name
 * @param errmsg
 */
function  has_error(class_name, second_class_name, errmsg){
    $("."+class_name).addClass('has-error');
    var error_html = '<div class="help-block col-sm-reset inline has-error">'+errmsg+'</div>';
    $("."+second_class_name).append(error_html);
}
function remove_error(class_name, second_class_name, errmsg){
    $("."+class_name).removeClass('has-error');
    $("."+second_class_name).remove();
}
/**
 * 通过ajax提交
 * @param url
 * @param data
 * @param location_href
 */
function ajax_submit(url, data, location_href, success_msg){
    if(!success_msg){
        success_msg = '添加成功';
    }
    $.ajax({
        async:false,
        type : 'POST',
        url: url,
        data : data,
        dataType : 'json',
        success: function (data)
        {
            if (data.result == '0000') {
                alert(success_msg);
                location.href = location_href;
            } else {
                alert(data.info);
            }
        }
    });
}
/**
 * 打印错误信息
 * @param name
 * @param error_msg
 */
function alert_error(name, error_msg){
    if(!name){
        alert(error_msg);
        return;
    }
}