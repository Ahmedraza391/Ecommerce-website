//import { Dropdown, Ripple, initMDB } from "mdb-ui-kit";
jQuery("#contact_form").validate({
    rules:{
        name : "required",
        email :{
            required:true,
            email:true
        },
        mobile:"required",
        message:"required"
    },messages:{
        name :"Name Field is Required",
        email :{
            required:"Email Field is Required",
            email : "Enter Valid Email"
        },
        mobile :"Contact Field is Required",
        message :"Message Field is Required",
    }
})
// initMDB({ Dropdown, Ripple });
document.addEventListener("DOMContentLoaded",function(){
    function dismis_btn(className){
        let div = document.querySelector(".dismis_container");
        div.style.top = "-1000px";
        div.classList.add = "dismis";
    }
    function open_alert(){
        let div = document.querySelector(".dismis_container");
        div.style.top = "0px";
        div.classList.add = "active";
    }
})
$(document).ready(function(){
    $("#sort_select").on("change",function(){
        let sort_val = $("#sort_select").val();
        $.ajax({
            url:"filter_price.php",
            type:"POST",
            data:{val : sort_val},
            success:(function(data){
                $("#searched_products").html(data);
                $("#products").css("display","none");
            })
        })
    })
})