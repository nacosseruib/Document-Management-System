@if($loadScript == 1)
<script>
    $(document).ready( function(){

        //FUNCTION TO ADD ITEM TO FAVOURITE
        $('.addFavourite').click(function() {
            var productID = this.id;
            if(productID !== "")
            {
                $.ajax({
                    url: '{{url("/add-favourite/")}}' + '/' + productID,
                    type: 'get',
                    data: { format: 'json' },
                    dataType: 'json',
                    success: function(data)
                    {
                        if(data.status === 200)
                        {
                            $(".favourite"+productID).removeClass("text-warning");
                            $(".favourite"+productID).addClass("text-info");
                            $(".favouritefavicon"+productID).removeClass("fa-star-o");
                            $(".favouritefavicon"+productID).addClass("fa-star");
                        }else{
                            $(".favourite"+productID).removeClass("text-info");
                            $(".favourite"+productID).addClass("text-warning");
                            $(".favouritefavicon"+productID).removeClass("fa-star");
                            $(".favouritefavicon"+productID).addClass("fa-star-o");
                        }
                        //location.reload(true);
                    },
                    error: function(error) {
                        alert("Please we are having issue adding your product to cart. Check your network/refresh this page !");
                        return;
                    }
                });
            }else{
                //$('#').html("Sorry, we cannot add this item to your cart now! Try again.").css('color', 'yellow').show();
            }//end if
        });


        //FUNCTION TO COMPUTE 4% DISPLAY PRICE
        $('#sellerPrice').keyup(function() {
            var sellerPrice = 0;
            var displayPrice = 0;
            $("#displayPrice").val('');
            sellerPrice = parseFloat(this.value.replace(/,/g, ""));
            displayPrice = (sellerPrice + ((0.04) * sellerPrice));
            displayPrice = (isNaN(displayPrice) ? 0 : displayPrice);
            $("#displayPrice").val(displayPrice.toFixed(2));
            $("#showDisplayPrice").html(displayPrice.toFixed(2));
        });

    });
</script>
@endif
