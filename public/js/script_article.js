$(document).ready(function(){   

        $("#btnCreate").click(function(e){
            $.ajax({
                dataType: "json",
                url: "article",
                type: "POST",
                data: $("#formCreate").serialize(),
                success: function(data){
                    console.log(data);
                    if(data['msg'] != 'error'){
                        $('#modalCreate').modal('toggle');
                    }
                }


            });

        });

        $("#btnUpdate").click(function(e){
            $.ajax({
                dataType: "json",
                url: "article",
                type: "POST",
                data: $("#formUpdate").serialize(),
                success: function(data){
                    console.log(data);
                    if(data['msg'] != 'error'){
                        $('#modalUpdate').modal('toggle');
                    }
                }


            });

        });

        // получаем данные в форму
        $('#modalUpdate').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var articleId = button.data('id'); // Extract info from data-* attributes

            console.log(articleId);
            $.ajax({
                dataType: "json",
                url: "article/"+articleId,
                type: "GET",
                success: function(data){
                    console.log(data);
                    if(data['msg'] != 'error'){
                        var modal = $("#formUpdate");
                        modal.find('#article-id').val(data.id);
                        modal.find('#article-name').val(data.name);
                        modal.find('#article-text').html(data.text);
                        modal.find('select option[value='+data.category_id+']').attr('selected','selected');
                    }
                }

            });        
        })

        // получаем данные для просмотра
        $('#modalView').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var articleId = button.data('id'); // Extract info from data-* attributes

            console.log(articleId);
            $.ajax({
                dataType: "json",
                url: "article/"+articleId,
                type: "GET",
                success: function(data){
                    console.log(data);
                    if(data['msg'] != 'error'){
                        var modal = $("#modalView");
                        modal.find('#view-id').html(data.id);
                        modal.find('#view-name').html(data.name);
                        modal.find('#view-text').html(data.text);
                        modal.find('#view-category').html(data.category.name);
                    }
                }

            });        
        })



        $('#modalDelete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var articleId = button.data('id'); // Extract info from data-* attributes
            var modal = $("#formDelete");
            modal.find('#article-id').val(articleId);
        })

        $("#btnDelete").click(function(e){
            $.ajax({
                dataType: "json",
                url: "article/"+$("#formDelete").find("#article-id").val(),
                type: "POST",
                data: $("#formDelete").serialize(),
                success: function(data){
                    console.log(data);
                    if(data['msg'] != 'error'){
                        $('#modalDelete').modal('toggle');
                    }
                }


            });

        });
});