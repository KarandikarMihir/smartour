function loadData(div,cmd,url){
    var divChk = document.getElementById(div);
    if (divChk) {
        var xmlHttp;
        xmlHttp=new XMLHttpRequest(); 
        url+="?KEY="+cmd;
        xmlHttp.onreadystatechange=function(){
            if(xmlHttp.readyState==4){
                document.getElementById(div).innerHTML=xmlHttp.responseText;
                setTimeout('loadData(div,cmd,url)',5000);
            }
        }
        xmlHttp.open("POST",url,true);
        xmlHttp.send(null);
    }            
}/*
var obj=self.setInterval(function(){loadData('msgcnt','fetchMsgCnt','request.php')},3000);
var obj=self.setInterval(function(){loadData('feedbk','fetchFeedbk','request.php')},3000);
var obj=self.setInterval(function(){loadData('enqtrk','fetchEnqTrk','request.php')},3000);
var obj=self.setInterval(function(){loadData('paychk','fetchPayChk','request.php')},3000);
*/
function loadResults(div,cmd,url,param){
    var xmlHttp;
    xmlHttp=new XMLHttpRequest(); 
    url+="?KEY="+cmd+"&SearchParam="+param;
    xmlHttp.onreadystatechange=function(){
        if(xmlHttp.readyState==4){
            document.getElementById(div).innerHTML=xmlHttp.responseText;
        }
    }
    xmlHttp.open("POST",url,true);
    xmlHttp.send(null);
}

function deleteRecord(recType,url,param,div){
    var xmlHttp;
    xmlHttp=new XMLHttpRequest(); 
    url+="?KEY="+recType+"&SearchParam="+param;
    xmlHttp.onreadystatechange=function(){
        if(xmlHttp.readyState==4){
            document.getElementById(div).innerHTML=xmlHttp.responseText;
        }
    }
    xmlHttp.open("POST",url,true);
    xmlHttp.send(null);
}

function addcity(){
    var xmlHttp;
    var city = $('#newcity').val();
    var state = $('#state').val();
    xmlHttp=new XMLHttpRequest(); 
    url="request.php?KEY=addcity&city="+city+"&state="+state;
    xmlHttp.onreadystatechange=function(){
        if(xmlHttp.readyState==4){
            location.reload(true);
        }
    }
    xmlHttp.open("POST",url,true);
    xmlHttp.send(null);
}
function addstate(){
    var xmlHttp;
    var state = $('#newstate').val();
    var country = $('#country').val();
    xmlHttp=new XMLHttpRequest(); 
    url="request.php?KEY=addstate&state="+state+"&country="+country;
    xmlHttp.onreadystatechange=function(){
        if(xmlHttp.readyState==4){
            location.reload(true);
        }
    }
    xmlHttp.open("POST",url,true);
    xmlHttp.send(null);
}

function addcountry(){
    var xmlHttp;
    var country = $('#newcountry').val();
    xmlHttp=new XMLHttpRequest(); 
    url="request.php?KEY=addcountry&country="+country;
    xmlHttp.onreadystatechange=function(){
        if(xmlHttp.readyState==4){
            location.reload(true);
        }
    }
    xmlHttp.open("POST",url,true);
    xmlHttp.send(null);
}

function addHotel(eid){
    var xmlHttp;
    var param = $('#apphotel').val();
    xmlHttp=new XMLHttpRequest(); 
    url="request.php?KEY=addhotel&hotel="+param+"&eid="+eid;
    xmlHttp.onreadystatechange=function(){
        if(xmlHttp.readyState==4){
            location.reload(true);
        }
    }
    xmlHttp.open("POST",url,true);
    xmlHttp.send(null);
}

function removeHotel(param, eid){
    var xmlHttp;
    xmlHttp=new XMLHttpRequest();
    url="request.php?KEY=removehotel&hotel="+param+"&eid="+eid;
    xmlHttp.onreadystatechange=function(){
        if(xmlHttp.readyState==4){
            location.reload(true);
        }
    }
    xmlHttp.open("POST",url,true);
    xmlHttp.send(null);

}

function removeRoom(param){
    var xmlHttp;
    xmlHttp=new XMLHttpRequest();
    url="request.php?KEY=removeroom&room="+param;
    xmlHttp.onreadystatechange=function(){
        if(xmlHttp.readyState==4){
            location.reload(true);
        }
    }
    xmlHttp.open("POST",url,true);
    xmlHttp.send(null);
}

