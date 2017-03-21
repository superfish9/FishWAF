// 添加ip rule
function addIPRule(ob)
{
    var type = $(ob).attr("ip-rule-type");
    var table = $("#" + type);
    table.append("<tr><input type=\"hidden\" name=\"type\" value=\"" + type + "\"><td><input name=\"path\" class=\"form-control\"></td><td><input name=\"ip\" class=\"form-control\"></td><td><button type=\"button\" class=\"btn btn-default fright\" onclick=\"makeForm(this)\">Save</button></td></tr>");
}

// 提交表单
function submitForm(ob)
{
    var targetForm = $(ob).closest('form');
    $(document).ready(function () {
        var options = {
            success: function (data) {
                var resp = JSON.parse(data);
                if (resp.status != 0) {
                    alert(resp.message);
                }
                else{
                    window.location.reload();
                }
            }
        }
        targetForm.ajaxSubmit(options);
    });
}

// 构建add ip rule表单
function makeForm(ob)
{
    var tr = $(ob).closest('tr');
    input_0 = tr.find('input:eq(0)');
    input_1 = tr.find('input:eq(1)');
    input_2 = tr.find('input:eq(2)');

    var my_form = $('<form></form>');
    my_form.attr('method', 'post');
    var my_input_0 = $('<input type="text" name="' + input_0.attr('name') + '" value="' + input_0.val() + '">');
    var my_input_1 = $('<input type="text" name="' + input_1.attr('name') + '" value="' + input_1.val() + '">');
    var my_input_2 = $('<input type="text" name="' + input_2.attr('name') + '" value="' + input_2.val() + '">'); 
    my_form.append(my_input_0);
    my_form.append(my_input_1);
    my_form.append(my_input_2);
    var my_button = $('<button type="button" onclick="submitForm(this)">my_button</button>');
    my_form.append(my_button);

    my_button.click();
}

// 获取request
function getRequest(ob)
{
    var rid = $(ob).attr("data-target");
    var div = $(rid + '-content');
    var form = $(ob).closest('form');
    $(document).ready(function () {
        var options = {
            success: function (data) {
                var resp = JSON.parse(data);
                div.html(resp.message);
                $(rid).modal();
            }
        }
        form.ajaxSubmit(options);
    });
}


