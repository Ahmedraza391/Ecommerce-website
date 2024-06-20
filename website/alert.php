<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alert box</title>
</head>
<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .main{
        width: 100vw;
        height: 100vh;
        background-color: #6d6d6dc0;
        display: flex;
        align-items: start;
        justify-content: center; 
        padding-top: 50px;
    }
    .dismis_container{
        min-width: 30vw;
        min-height: 10vh;
        background-color: #ffff;
        border-radius: 10px;
        padding: 30px;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
        transition: .3s;
        position: relative;
        top: -1000px;
    }
    .dismis_btn{
        position: absolute;
        top: 10px;
        right: 10px;
    }
    .dismis_btn button{
        padding: 2px 10px;
        border: none;
        outline: none;
        cursor: pointer;
        font-weight: bolder;
        transition: .1s;
        border-radius: 3px;

    }
    .dismis_btn button:hover{
        color: #ffff;
        background-color: #f13e3e;
    }
</style>
<body>
    <div class="main">
        <div class="dismis_container dismis">
            <div class="dismis_btn">
                <button onclick="dismis_btn()">X</button>
            </div>
            <h3>Alert Box</h3>
        </div>
        <button onclick="open_alert()">Open</button>
    </div>
</body>
<script>
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
</script>
</html>