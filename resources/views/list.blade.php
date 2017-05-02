<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Ajax ToDo List Project</title>
</head>
<body>
<br>
<div class="container">
    <div class="row">
        <div class="col-lg-offset-3 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">AJax ToDo List <a href="#" class="pull-right"  id="addNew" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i></a></h3>
                </div>

                <div class="panel-body" id="items">
                    <ul class="list-group">
                        @foreach($items  as $item)
                        <li class="list-group-item ourItem"  data-toggle="modal" data-target="#myModal">{{ $item->item }}
                            <input type="hidden" id="itemId" value="{{ $item->id }}">
                        </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>

        {{--Modal --}}
        <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="title">Add New Item</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id">
                        <p><input type="text" placeholder="Write Item Here" id="addItem" class="form-control" ></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal" id="delete" style="display: none;">Delete</button>
                        <button type="button" class="btn btn-primary" id="saveChanges" style="display: none;">Save changes</button>
                        <button type="button" class="btn btn-primary" id="AddButton" data-dismiss="modal">Add Item</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</div>

{{ csrf_field() }}

<script src="http://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script>
//    $('.ourItem').each(function(){ });
   $(document).ready(function () {
    $(document).on('click', '.ourItem', function (event) {

                var text = $(this).text();
                var id = $(this).find('#itemId').val();

                $('#title').text('Edit Item');
                $('#addItem').val(text);
                $('#delete').show('400');
                $('#saveChanges').show('400');
                $('#AddButton').hide('400');
                $('#id').val(id);
                  console.log(text);
//        $(this).click(function (event) {                });
        });

            $(document).on('click', '#addNew', function (event) {
                $('#title').text('Add New Item');
                $('#addItem').val("");
                $('#delete').hide('400');
                $('#saveChanges').hide('400');
                $('#AddButton').show('400');
            });

    //console.log(text);
//    $('#addNew').click(function (event) {
//            });

            // AJAX POST DATA
            $('#AddButton').click(function (event) {
                var text = $('#addItem').val();
                $.post('list', {'text' : text,'_token':$('input[name=_token]').val()}, function(data) {
                    console.log(data);
                    $('#items').load(location.href + ' #items'); //Refreshing the pages
                });
            });

           // Delete with Ajax
        $('#delete').click(function(event) {
            var id = $("#id").val();  // id fom the modal
            //Post the Id to the Controller
            $.post('delete', {'id' : id,'_token':$('input[name=_token]').val()}, function(data) {
                console.log(data);
                $('#items').load(location.href + ' #items'); //Refreshing the pages
            });

        });
    });
</script>
</body>
</html>