var infinitePosts_page = 1;
var infinitePosts_end = false;
var infinitePosts_loadingPosts = false;
var infinitePosts_firstLoading = true;
infinitePosts(infinitePosts_page);
function infinitePosts(postId) {
    if(infinitePosts_loadingPosts)
        return;
    infinitePosts_loadingPosts = true;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if(xhr.readyState === 4 && xhr.status === 200) {
            if(xhr.responseText.length > 0) {
				document.getElementById("infinitePosts").insertAdjacentHTML('beforeend', xhr.responseText);
				initTooltips();
				infinitePosts_page += 1;
				if(infinitePosts_firstLoading)
					waitForScrollOrEnd();
            } else {
                infinitePosts_end = true;
				if(infinitePosts_firstLoading) {
					if(document.getElementById("infinitePosts_noPosts"))
						document.getElementById("infinitePosts_noPosts").classList.remove('d-none');
				} else {
					if(document.getElementById("infinitePosts_end"))
						document.getElementById("infinitePosts_end").classList.remove('d-none');
				}
				if(document.getElementById("infinitePosts_loading"))
					document.getElementById("infinitePosts_loading").classList.add('d-none');
            }
			if(infinitePosts_firstLoading)
				infinitePosts_firstLoading=false;
            infinitePosts_loadingPosts = false;
        }
    };
    xhr.open("GET", infinitePosts_url + infinitePosts_page, true);
    xhr.send();
}
window.onscroll = function(ev) {
    if(!infinitePosts_end) {
        if(window.innerHeight + window.scrollY + 1 >= document.documentElement.scrollHeight) {
            setTimeout(function() {
                infinitePosts();
            }, 500);
        }
    }
};
function waitForScrollOrEnd() {
    if (infinitePosts_end || document.documentElement.scrollHeight > window.innerHeight)
        return;
    setTimeout(function () {
        infinitePosts();
        waitForScrollOrEnd();
    }, 500);
}