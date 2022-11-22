var select = document.getElementById("tipoDeResorte");
var nodeList = document.querySelectorAll(".hide");


select.addEventListener('change', function(){
    if(this.value != "Personalizado"){
        hide(true);
    }else{
        hide(false);
    }
})

function hide(a){
    if(a){
        for (let i = 0; i < nodeList.length; i++) {
            nodeList[i].style.display = "none";
        }
    }else{
        for (let i = 0; i < nodeList.length; i++) {
            nodeList[i].style.display = "block";
        }
    }
}