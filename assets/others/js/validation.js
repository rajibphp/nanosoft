function disabledMsg2(fieldId, submitId, msg){
    if(msg){ alert(msg); }
    submitId.prop('disabled', true);
    fieldId.css("background-color", "red");
}
function enabledMsg2(fieldId, submitId){
    submitId.prop('disabled', false);
    fieldId.css("background-color", "");
}
function elementId(id_arr){
    var id = id_arr.split("_");
    return id[id.length - 1];
}
function timeAmPm(date){
    var d = new Date(date);
    return d.toLocaleString([], { hour: '2-digit', minute: '2-digit' }); 
}
    
function disabledMsg(fieldId, msg){
    if(msg){
        alert(msg);
    }else{
        alert('Invalid Format or Duplicate!');
    }

    $("#submit").prop('disabled', true);
    fieldId.css("background-color", "red");
}
function enabledMsg(fieldId){
    $("#submit").prop('disabled', false);
    fieldId.css("background-color", "");
}
function requiredAttr(fieldId, trueFalse){ 
    document.getElementById(fieldId).required = trueFalse;
}