$(document).ready(function(){
    $('.listing-type').click(function(){
        $('.pagination-loader').removeClass('d-none');
        var page = 1;
        $('.listing-type').removeClass('active active-list');
        $(this).addClass('active active-list');
        listingData(page);
    });
    $(document).on('click', '.pagination a', function(event){
        $('.pagination-loader').removeClass('d-none');
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        $('#hidden_page').val(page);
        $('.pagination li').removeClass('active');
        $(this).parent().addClass('active');
        listingData(page);
        /*$('html, body').animate({
                        scrollTop: $(".search-form").offset().top
                    }, 1500);*/
    });

	$(document).on('keyup', '#ledger_search', function () {
		var page = 1;
		var query = $(this).val();
		listingData(page,query);
		
	});
	
    function listingData(page,query=null)
    {
		 var route;
          var value;
        if($(".listing-type").hasClass("active-list")) 
        {
             route= $(".active-list").data('url');
           
             value= $(".active-list").data('value');
        }
        console.log(route);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: route+"/?page="+page,
            data:{value:value,query:query},
            method:"GET",
            success:function(data)
            {                  
                $('.pagination-loader').addClass('d-none');
                if(data.isSucceeded){

                $('.dynamic-listing').html('');
                $('.dynamic-listing').html(data.data);
                }else{
                $('.dynamic-listing').html(data.data);
                }
            }
        });
    }
});