document.addEventListener("DOMContentLoaded",function(){
    var search = document.getElementById("search_product");
    search.addEventListener("click",function(){
        document.getElementById("search_box").classList.toggle("show");
        
    })
    document.getElementById("close_serach").addEventListener("click",function(){
        document.getElementById("search_box").classList.remove("show");
    })
})