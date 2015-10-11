$(function () {

    //文件上传
    $('#doc-form-file').on('change', function () {
        var fileNames = '';
        $.each(this.files, function () {
            fileNames += '<span class="am-badge">' + this.name + '</span> ';
        });

        // fileNames = '<span class="am-badge">' + $(this).name + '</span> ';

        $('#file-list').html(fileNames);
    });

    var opts = {
        url: "/upload",
        type: "POST",
        beforeSend: function () {
            $("#loading").attr('class', 'am-icon-spinner am-icon-spin');
        },

        success: function (result, status, xhr) {
            $("#loading").attr('class', 'am-icon-cloud-upload');
            $('#logo').val(result.info);
            $('#brand_logo_img ').attr('src', result.info);
            //console.log(result);
        },

        error: function (result, status, errorThrown) {
            $("#loading").attr('class', 'am-icon-cloud-upload');
        }
    }


    $('#doc-form-file').fileUpload(opts);

});