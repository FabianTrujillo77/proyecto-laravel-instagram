
var url = 'http://proyecto-laravel.test';

window.addEventListener("load", function(){

    $('.btn-like').css('cursor', 'pointer');
    $('btn-dislike').css('cursor', 'pointer');

    // Boton de like
    function like()
    {
        $('.btn-like').unbind('click').click(function(){
            console.log('like');
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url+'/images/heart-red.png');

            $.ajax({
                url: url+'/like/'+$(this).data('id'),
                type: 'GET',
                success: function(response)
                {
                    if(response.like)
                    {
                        console.log('Has dado like a la publicacion');
                    }
                    else
                    {
                        console.log('Error al dar like'); 
                    }
                }
            });
            dislike();
        });
    }

    like();

    // Boton de dislike
    function dislike()
    {
        $('.btn-dislike').unbind('click').click(function(){
            console.log('dislike');
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url+'/images/heart-gray.png');

            $.ajax({
                url: url+'/dislike/'+$(this).data('id'),
                type: 'GET',
                success: function(response)
                {
                    if(response.like)
                    {
                        console.log('Has dado dislike a la publicacion');
                    }
                    else
                    {
                        console.log('Error al dar dislike'); 
                    }
                }
            });
            like();
        });
    }
    dislike();

    // Buscador
    $('#buscador').submit(function(e){
        $(this).attr('action', url+'/gente/'+$('#buscador #search').val());
    })

});

