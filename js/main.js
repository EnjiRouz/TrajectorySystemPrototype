function _(id){
    return document.getElementById(id);
}

function allowDrop(event) {
    event.preventDefault();
}

function drag(event) {
    event.dataTransfer.setData("id", event.target.id);
    event.dataTransfer.setData("block", event.target.title);
}

function drop(event, block) {
    event.preventDefault();
    let data = event.dataTransfer.getData("id");
    let blockClass=event.dataTransfer.getData("block");

    let tip = document.querySelector(".tip");
    let objectsInDropZoneCount=_("drop_zone").children.length;

    if(objectsInDropZoneCount===1){
        if(!tip.classList.contains("hide-tip")) {
            tip.classList.add("hide-tip");
        }
    }

    if(objectsInDropZoneCount===6){
        alert("Необходимо выбрать 5 программ для получения результата");
    } else block.appendChild(_(data));

    if(block.className === "object-zone"){
        if(objectsInDropZoneCount===1) {
            if (tip.classList.contains("hide-tip")) {
                tip.classList.remove("hide-tip");
            }
        }
        _(blockClass).appendChild(_(data));
    }
}

function readDropZoneData(){
    let objectsInDropZone=_("drop_zone").children;
    let chosenPrograms = [];

    if (objectsInDropZone.length===6) {
        for (let i = 1; i < objectsInDropZone.length; i++) {
            let objectId = objectsInDropZone[i].id;
            alert("Вы выбрали программы с id "+ (objectId));
            chosenPrograms.push(objectId);
        }
        setUserData(chosenPrograms.toString());
    } else  alert("Необходимо выбрать 5 программ для получения результата");
}

function setUserData(chosenPrograms){
    let userData={};
    //document.getElementById("form_email").value;
    userData.email="john@doe.ya";
    userData.name= "Enji Rouz Inc";
    userData.direction="09.03.04 Программная инженерия";
    userData.chosenPrograms=chosenPrograms;

    let httpRequest= new XMLHttpRequest();
    let url="resources/database.php";

    httpRequest.open("POST",url,true);

/*    httpRequest.onreadystatechange=function(){
        if(httpRequest.readyState===4 && httpRequest.status===200){

        }
    }*/
    httpRequest.send(userData);
}


