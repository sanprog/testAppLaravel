$(document).ready(function(){   

        $("#btnCreate").click(function(e){
            $.ajax({
                dataType: "json",
                url: "category",
                type: "POST",
                data: $("#formCreate").serialize(),
                success: function(data){
                    if(data['msg'] != 'error'){
                        $('#modalCreate').modal('toggle');
                    }
                }


            });

        });

        $("#btnUpdate").click(function(e){
            $.ajax({
                dataType: "json",
                url: "category",
                type: "POST",
                data: $("#formUpdate").serialize(),
                success: function(data){
                    if(data['msg'] != 'error'){
                        $('#modalUpdate').modal('toggle');
                    }
                }


            });

        });

        // получаем данные в форму
        $('#modalUpdate').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var categoryId = button.data('id'); // Extract info from data-* attributes

            $.ajax({
                dataType: "json",
                url: "category/"+categoryId,
                type: "GET",
                success: function(data){
                    if(data['msg'] != 'error'){
                        var modal = $("#formUpdate");
                        modal.find('#category-id').val(data.id);
                        modal.find('#category-name').val(data.name);
                    }
                }

            });        
        })

        // получаем данные для просмотра
        $('#modalView').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var categoryId = button.data('id'); // Extract info from data-* attributes

            $.ajax({
                dataType: "json",
                url: "category/"+categoryId,
                type: "GET",
                success: function(data){
                    if(data['msg'] != 'error'){
                        var modal = $("#modalView");
                        modal.find('#view-id').html(data.id);
                        modal.find('#view-name').html(data.name);
                    }
                }

            });        
        })



        $('#modalDelete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var articleId = button.data('id'); // Extract info from data-* attributes
            var modal = $("#formDelete");
            modal.find('#category-id').val(articleId);
        })

        $("#btnDelete").click(function(e){
            $.ajax({
                dataType: "json",
                url: "category/"+$("#formDelete").find("#category-id").val(),
                type: "POST",
                data: $("#formDelete").serialize(),
                success: function(data){
                    if(data['msg'] != 'error'){
                        $('#modalDelete').modal('toggle');
                    }
                }


            });

        });
});