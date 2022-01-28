var count = "250";
function limiter(){
	var tex = document.miterform.miter.value;
	var len = tex.length;
	var sub_but = document.getElementById('sub_but');
	if(len > count){
        sub_but.disabled = true;
		sub_but.style.color = '#c10000';
	} else {
	    sub_but.disabled = false;
		sub_but.style.color = '#000000';
	}	
	document.miterform.submit.value = count-len;
}

function confirm_delete() {
	return confirm('Delete?');
}

function validate() {
    var miterbox = document.forms["miterform"]["miter"].value;
    if (miterbox == "") {
        return false;
	}
}