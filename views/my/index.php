
<form class="form-inline ">
    <input id="search" class="form-control" type="text" placeholder="Search">
    <input type="button" id="submit" class="btn-success btn" value="search">
</form>

</br>

<div  class="container">
    <div class="row" id="resImg"></div>
</div>
</br>
<button class="btn btn-success" id="loadMore" value="2">LoadMore</button>
<?php
?>

<?php
$js=<<<JS
    function output(url, id){
        $('<div  class="col-md-4" style="height:250px:overflow:hidden">').html(
            
            '<a href="image/'+id+
            '"><img class="" style="width:100%;height:auto;object-position: center;" src="'+url + '"></a>'+
            '</div>',
        ).appendTo('#resImg')
    }
    
    
    $('#submit').on('click',function(){ 
        $.ajax({
            type:'POST',
            dataType:'JSON',            
            data:{
                search: $('#search').val(),
                page: 1
            },
            success:function(res) { 
                $('#resImg').empty();
                console.log(res);
                for (i=0;i<20;i++){
                    output(res[i]['smallImgUrl'],res[i]['id'])
                }
            }
            });
    });
    $('#loadMore').on('click',function() {
        $.ajax({
            type:'POST',
            dataType:'JSON',            
            data:{
                search: $('#search').val(),
                page: $('#loadMore').val(),
            },     
            success:function(res) {
                var a=parseInt($('#loadMore').attr('value')); 
                $('#loadMore').attr('value',++a);
                for (i=0;i<20;i++){
                    console.log(res[i]['serviceId']);
                    output(res[i]['smallImgUrl'],res[i]['id'])
                }
            }
            });
    });
JS;
$this->registerJs($js);
?>
