var input_query_id = 'query';
var output_results = document.getElementById('results');
var box_loading = document.getElementById('searchLoading');
var box_endSearch = document.getElementById('endSearch');
var box_noResults = document.getElementById('noResults');

var input_query = document.getElementById(input_query_id);
var	searchPage = 1;
var	searchFirstLoading = true;
var	searchEnd = false;
var	searchLoading = false;

function setVisible(item, visible=true) {
	if(visible){
		if(item)
			item.classList.remove("d-none");
	} else {
		if(item)
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
	
	searchLoading = true;
	setVisible(box_loading);
	
	var searchParams = new URLSearchParams();
	searchParams = addParam(searchParams, 'query', 'query');
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
    xhr.open("GET", search_url + '?' + searchParams.toString(), true);
    xhr.send();
	searchLoading = false;
	if(window.innerHeight + window.scrollY == document.documentElement.scrollHeight) {
		if(!searchEnd) {
			setTimeout(function() {
				search();
			}, 500);
		}
	}
}

function reloadSearch() {
	searchPage = 1;
	searchFirstLoading = true;
	searchEnd = false;
	searchLoading = false;
	setVisible(box_noResults,false);
	setVisible(box_endSearch,false);
	output_results.innerHTML = '';
	search();
}

reloadSearch();

window.onscroll = function(ev) {
    if(!searchEnd) {
        if(window.innerHeight + window.scrollY + 1 >= document.documentElement.scrollHeight) {
            setTimeout(function() {
                search();
            }, 500);
        }
    }
};

function waitForScrollOrEnd() {
    if (searchEnd || document.documentElement.scrollHeight > window.innerHeight)
        return;
    setTimeout(function () {
        search();
        waitForScrollOrEnd();
    }, 500);
}