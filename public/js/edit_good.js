/**
 * Created by Aaron on 9/09/15.
 */
//初始化，编辑用
function build_input_old(attribute, value, append) {
    var html = "";
    //如果是唯一属性
    if (attribute.attr_type == 0) {
        switch (attribute.input_type) {
            //手工录入，单行文本
            case '0':
                html += '<div class="am-g am-margin-top">' +
                    '<div class="am-u-sm-4 am-u-md-2 am-text-right">' + attribute.name + '</div>' +
                    '<input type="hidden" name="attr_id_list[]" value="' + attribute.id + '">' +
                    '<div class="am-u-sm-8 am-u-md-4 am-u-end">' +
                    '<input type="text" class="am-input-sm" name="attr_value_list[]" value="'+value.attr_value+'">' +
                    '</div>' +
                    '</div>';
                break;
            //列表
            default:
                var values = attribute.value.split("\r\n");
                var options = "<option value=''>请选择...</option>";
                $.each(values, function (k, v) {
                    options += '<option ';
                    if(v==value.attr_value){
                        options += ' selected ';
                    }
                    options +='value="' + v + '">' + v + '</option>';
                })
                html += '<div class="am-g am-margin-top">' +
                    '<div class="am-u-sm-4 am-u-md-2 am-text-right">' + attribute.name + '</div>' +
                    '<input type="hidden" name="attr_id_list[]" value="' + attribute.id + '">' +
                    '<div class="am-u-sm-8 am-u-md-10">' +
                    '<select class="att_select" name="attr_value_list[]">' +
                    options +
                    '</select>' +
                    '</div>' +
                    '</div>';
                break;
        }
        html += '<input type="hidden" value="0" class="am-input-sm money" name="attr_price_list[]" placeholder="属性价格">';

    } else {
        switch (attribute.input_type) {
            //手工录入，单行文本
            case 0:
                html += '<div class="am-g am-margin-top">' +
                    '<div class="am-u-md-4 am-u-md-offset-2">' +
                    '<input type="hidden" name="attr_id_list[]" value="' + attribute.id + '">' +
                    '<input type="text" class="am-input-sm" name="attr_value_list[]" value="'+value.attr_value+'>' +
                    '</div>';
                break;
            //列表
            default:
                var values = attribute.value.split("\r\n");
                var options = "<option value=''>请选择...</option>";
                $.each(values, function (k, v) {
                    options += '<option ';
                    if(v==value.attr_value){
                        options += ' selected ';
                    }
                    options +='value="' + v + '">' + v + '</option>';
                })
                html += '<div class="am-g am-margin-top">' +
                    '<div class="am-u-md-3 am-u-md-offset-2">' +
                    '<input type="hidden" name="attr_id_list[]" value="' + attribute.id + '">' +
                    '<select class="att_select" name="attr_value_list[]">' +
                    options +
                    '</select>' +
                    '</div>';
                break;
        }
        html += '<div class="am-u-md-2">' +
            '<input type="text" class="am-input-sm money" name="attr_price_list[]" placeholder="属性价格" value="'+value.attr_price+'">' +
            '</div>' +
            '<div class="am-u-md-2 am-u-end col-end">';


        if (append == true) {
            html += '<button type="button" class="am-btn am-btn-danger am-round trash1">';
        } else {
            html += '<button type="button" class="am-btn am-btn-danger am-round trash0">';
        }
        html += '<span class="am-icon-trash"> 删除</span>' +
            '</button>' +
            '</div>' +
            '</div>';
    }
    return html;
}

function build_input(attribute, append) {
    var html = "";
    //如果是唯一属性
    if (attribute.attr_type == 0) {
        switch (attribute.input_type) {
            //手工录入，单行文本
            case 0:
                html += '<div class="am-g am-margin-top">' +
                    '<div class="am-u-sm-4 am-u-md-2 am-text-right">' + attribute.name + '</div>' +
                    '<input type="hidden" name="attr_id_list[]" value="' + attribute.id + '">' +
                    '<div class="am-u-sm-8 am-u-md-4 am-u-end">' +
                    '<input type="text" class="am-input-sm" name="attr_value_list[]">' +
                    '</div>' +
                    '</div>';
                break;
            //列表
            default:
                var values = attribute.value.split("\r\n");
                var options = "<option value=''>请选择...</option>";
                $.each(values, function (k, v) {
                    options += '<option value="' + v + '">' + v + '</option>';
                })
                html += '<div class="am-g am-margin-top">' +
                    '<div class="am-u-sm-4 am-u-md-2 am-text-right">' + attribute.name + '</div>' +
                    '<input type="hidden" name="attr_id_list[]" value="' + attribute.id + '">' +
                    '<div class="am-u-sm-8 am-u-md-10">' +
                    '<select class="att_select" name="attr_value_list[]">' +
                    options +
                    '</select>' +
                    '</div>' +
                    '</div>';
                break;
        }
        html += '<input type="hidden" value="0" class="am-input-sm money" name="attr_price_list[]" placeholder="属性价格">';

    } else {
        switch (attribute.input_type) {
            //手工录入，单行文本
            case 0:
                html += '<div class="am-g am-margin-top">' +
                    '<div class="am-u-md-4 am-u-md-offset-2">' +
                    '<input type="hidden" name="attr_id_list[]" value="' + attribute.id + '">' +
                    '<input type="text" class="am-input-sm" name="attr_value_list[]">' +
                    '</div>';
                break;
            //列表
            default:
                var values = attribute.value.split("\r\n");
                var options = "<option value=''>请选择...</option>";
                $.each(values, function (k, v) {
                    options += '<option value="' + v + '">' + v + '</option>';
                })
                html += '<div class="am-g am-margin-top">' +
                    '<div class="am-u-md-3 am-u-md-offset-2">' +
                    '<input type="hidden" name="attr_id_list[]" value="' + attribute.id + '">' +
                    '<select class="att_select" name="attr_value_list[]">' +
                    options +
                    '</select>' +
                    '</div>';
                break;
        }
        html += '<div class="am-u-md-2">' +
            '<input type="text" class="am-input-sm money" name="attr_price_list[]" placeholder="属性价格">' +
            '</div>' +
            '<div class="am-u-md-2 am-u-end col-end">';


        if (append == true) {
            html += '<button type="button" class="am-btn am-btn-danger am-round trash1">';
        } else {
            html += '<button type="button" class="am-btn am-btn-danger am-round trash0">';
        }
        html += '<span class="am-icon-trash"> 删除</span>' +
            '</button>' +
            '</div>' +
            '</div>';
    }
    return html;
}

var type_key;
var attributes;

//生成完整表单
function build_form() {
    var html = "";
    var type_id = $("#select_type option:selected").val();

    //如果类型id等于当前商品的类型id，那么还是回到初始化的表单
    if(type_id == good_type_id) {
        build_form_old();
        return false;
    }

    type_key = $("#select_type option:selected").attr("data-type_key");
    if (type_key == "") {
        $("#attributes").html(html);
        return false;
    }

    attributes = types[type_key].attributes;
    $.each(attributes, function (k, attribute) {
        if (attribute.attr_type == 1) {
            //如果是单选属性
            html += '<div class="am-g am-margin-top">' +
                '<div class="am-u-md-2 am-text-right">' + attribute.name + '</div>' +
                '<div class="am-u-md-10">' +
                '<button type="button" class="am-btn am-btn-warning am-round add_attribute" data-k="' + k + '">' +
                '<span class="am-icon-plus"> 新增</span>' +
                '</button>' +
                '</div>' +
                '</div>';
        }
        html += build_input(attribute);
    })

    $("#attributes").html(html);

    //重设样式
    $('.att_select').selected({
        btnSize: 'sm',
        btnStyle: 'secondary',
        maxHeight: '360',
    });
}

//表单初始化，编辑用
function build_form_old() {
    var html = "";
    type_key = $("#select_type option:selected").attr("data-type_key");
    if (type_key == "") {
        $("#attributes").html(html);
        return false;
    }
    attributes = types[type_key].attributes;
    $.each(attributes, function (k, attribute) {
        if (attribute.attr_type == 1) {
            //如果是单选属性
            html += '<div class="am-g am-margin-top">' +
                '<div class="am-u-md-2 am-text-right">' + attribute.name + '</div>' +
                '<div class="am-u-md-10">' +
                '<button type="button" class="am-btn am-btn-warning am-round add_attribute" data-k="' + k + '">' +
                '<span class="am-icon-plus"> 新增</span>' +
                '</button>' +
                '</div>' +
                '</div>';
        }
        var index = 0;
        $.each(good_attrs, function(key, value){
            //console.log(index);
            if(value.attr_id == attribute.id) {
                if(index == 0) {
                    html += build_input_old(attribute, value);
                } else {
                    html += build_input_old(attribute, value, true);
                }
                index++;
            }
        })
    })

    $("#attributes").html(html);

    //重设样式
    $('.att_select').selected({
        btnSize: 'sm',
        btnStyle: 'secondary',
        maxHeight: '360',
    });
}

$(function () {
    //打开页面就生成form
    build_form_old();

    //发生变化后，重新生成form
    $("#select_type").change(function () {

        build_form();
    });

    //增加属性
    $(document).on("click", ".add_attribute", function () {
        var k = $(this).attr('data-k');
        var html = build_input(attributes[k], true);
        $(this).parents(".am-g").next().after(html);
        //重设样式
        $('.att_select').selected({
            btnSize: 'sm',
            btnStyle: 'secondary',
            maxHeight: '360',
        });
    })

    //删除属性
    $(document).on("click", ".trash1", function () {
        $(this).parents(".am-g").remove();
    });

    $(document).on("click", ".trash0", function () {
        $(this).parents('.am-g').find('.money').val('');
    });
})

