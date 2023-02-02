{{-- <!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  
</head>
<body>

<div class="container">
  <h2>Basic Modal Example</h2>
  <!-- Trigger the modal with a button -->
    <form action="">
        <input type="checkbox" data-toggle="modal" data-target="#myModal" class="checkbox" name="[]" value="1">
        <br>
        <input type="checkbox" data-toggle="modal" data-target="#myModal" class="checkbox" name="[]" value="2">
    </form>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close btnclose" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btnclose" data-dismiss="modal" >Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
    $('.checkbox').on('click', function(){
        $value = $(this).val();
        $.ajax({
            type: "GET",
            url: "{{ route('product.demo') }}",
            data: $(this).val(),
            dataType: "html",
            success: function (response) {
                $('#myModal').toggle();
                if($('#myModal').hide()){
                    $(this).parents().find('.checkbox').prop('checked',false);
                };
                $('.btnclose').on('click',function(){
                    $(this).parents().find('.checkbox').prop('checked',false);
                })
            }
        });
    })
    
	
</script>
</body>

</html> --}}