




var input_query_id = 'query';
var input_type_id = 'type';
var output_results = document.getElementById('results');
var box_loading = document.getElementById('searchLoading');
var box_endSearch = document.getElementById('endSearch');
var box_noSearch = document.getElementById('noSearch');
var box_noResults = document.getElementById('noResults');

var input_query = document.getElementById(input_query_id);
var input_type = document.getElementById(input_type_id);
var searchPage = 1;
var searchEnd = false;
var searchLoading = false;
var searchFirstLoading = true;

function setVisible(item, visible=true) {
	if(visible){
		item.classList.remove("d-none");
	} else {
		item.classList.add("d-none");
	}
}

function addParam(searchParams, fieldId, paramName) {
	if(document.getElementById(fieldId)) {
		var fieldValue = document.getElementById(fieldId).value;
		if(fieldValue.trim() !== "")
			searchParams.append(paramName, fieldValue);
	}
	return searchParams;
}


function search() {
	if(searchLoading)
        return;
	
	if(input_query.value=="") {
		setVisible(box_noSearch);
		setVisible(box_loading,false);
		searchEnd = true;
		return;
	}
	
	searchLoading = true;
	
	var searchParams = new URLSearchParams();
	searchParams = addParam(searchParams, 'query', 'query');
	searchParams = addParam(searchParams, 'type', 'type');
	searchParams.append('page', searchPage);
	
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if(xhr.readyState === 4 && xhr.status === 200) {
            if(xhr.responseText.length > 0) {
				output_results.insertAdjacentHTML('beforeend', xhr.responseText);
				initTooltips();
				searchPage += 1;
				if(searchFirstLoading) {
					searchFirstLoading=false;
					waitForScrollOrEnd();
				}
            } else {
				searchEnd = true;
                if(output_results.innerHTML == 0)
					setVisible(box_noResults);
				else
					setVisible(box_endSearch);
				setVisible(box_loading,false);
            }
        }
    };
    xhr.open("GET", '{jsp$url}/ajax/search?' + searchParams.toString(), true);
    xhr.send();
	if(window.innerHeight + window.scrollY == document.documentElement.scrollHeight) {
		if(!searchEnd) {
			setTimeout(function() {
				search();
			}, 500);
		}
	}
}

function waitForScrollOrEnd() {
    if (searchEnd || document.documentElement.scrollHeight > window.innerHeight)
        return;
    setTimeout(function () {
        search();
        waitForScrollOrEnd();
    }, 500);
}

function reloadSearch() {
	searchPage = 1;
	searchEnd = false;
	searchLoading = false;
	searchFirstLoading = true;
	setVisible(box_noResults,false);
	setVisible(box_endSearch,false);
	setVisible(box_noSearch,false);
	output_results.innerHTML = '';
	search();
}

reloadSearch();

window.onscroll = function(ev) {
    if(!searchEnd) {
        if(window.innerHeight + window.scrollY + 1 >= document.documentElement.scrollHeight) {
            setTimeout(function() {
                search();
            }, 400);
        }
    }
}

