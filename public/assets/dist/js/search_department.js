let search_inp = document.getElementById('search-inp');
let search_result = document.getElementById('search-result');

search_inp.onkeyup = function(){
    let search_data = search_inp.value;
    let dataRequest = new XMLHttpRequest;
    dataRequest.onreadystatechange = function(){
        if( this.readyState == 4 && this.status ){
            search_result.innerHTML = this.responseText;
        }
    }

    dataRequest.open("GET","department_search.php?data="+search_data,true);
    dataRequest.send();
}