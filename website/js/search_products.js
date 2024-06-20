$(document).ready(function(){
    // by clicking search btn products
    $("#btn_search").on("click",function(event){
        event.preventDefault();
        var input = $("#search_input").val();
        $.ajax({
            url : "searching_products.php",
            type : "POST",
            data:{data:input},
            success:function(e){
                $("#products").css("display","none");
                $("#searched_products").html(e);
            }
        })
    })
    // on key press products
    $("#search_input").keyup(function(){
        var input = $("#search_input").val();
        $.ajax({
            url: "searching_products.php",
            type: "POST",
            data: {data: input},
            success: function(e){
                if(input.length === 0) {
                    $("#products").css("display", "grid");
                    $("#searched_products").html("");
                    alert("")
                } else {
                    $("#products").css("display", "none");
                    $("#searched_products").html(e);
                }
            }
        });
    });

})